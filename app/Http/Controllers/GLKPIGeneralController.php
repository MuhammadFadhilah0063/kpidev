<?php

namespace App\Http\Controllers;

use App\Models\GLKPIGeneral;
use App\Models\GLKPIGeneralApprove;
use App\Models\GLKPIGeneralItem;
use App\Models\KamusKPIGeneral;
use App\Models\Periode;
use App\Models\User;
use App\Services\BadgeService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class GLKPIGeneralController extends Controller
{
    protected $badgeService;

    public function __construct(BadgeService $badgeService)
    {
        $this->badgeService = $badgeService;
    }

    public function index(Request $request)
    {
        // Badge KPI Admin Menunggu Approve
        $countKPI = $this->badgeService->getCountKPIAdmin();

        // Badge GL KPI Menunggu Approve Pada Section
        $countKPIGL = $this->badgeService->getCountKPIGL();

        $subdivisi = strtoupper(explode('/', $request->path())[2]);

        // Yajra DataTables
        if (request()->ajax()) {
            if (Auth::user()->kategori == "MASTER") {
                $kpis = GLKPIGeneral::where("subdivisi", $subdivisi)
                    ->whereNot("status", "approve")
                    ->orderBy("id", "DESC")
                    ->with("user")
                    ->get();
            } else {
                $kpis = GLKPIGeneral::where("subdivisi", $subdivisi)
                    ->whereNot("status", "approve")
                    ->orderBy("id", "DESC")
                    ->with("user")
                    ->get();
            }

            return DataTables::of($kpis)
                ->make(true);
        }

        $periodes = Periode::orderBy("id", "desc")->get();

        // Kamus General Berdasarkan Sub Divisi - Cari Yang Aktif / Memiliki Baris
        $kamuss = KamusKPIGeneral::with("indicator_items")
            ->where("subdivisi", $subdivisi)
            ->whereNotNull("baris")
            ->orderBy("baris", "asc")
            ->get();

        if (Auth::user()->kategori == "MASTER") {
            $users = User::where("kategori", "GROUP LEADER")->where("subdivisi", $subdivisi)->get();
            return view('dashboard.gl_kpi_generals.index', compact("periodes", "subdivisi", "countKPI", "countKPIGL", "users", "kamuss"));
        }

        return view('dashboard.gl_kpi_generals.index', compact("periodes", "subdivisi", "countKPI", "countKPIGL", "kamuss"));
    }

    public function check()
    {
        // Badge KPI Admin Menunggu Approve
        $countKPI = $this->badgeService->getCountKPIAdmin();

        // Badge GL KPI Menunggu Approve Pada Section
        $countKPIGL = $this->badgeService->getCountKPIGL();

        // Yajra DataTables
        if (request()->ajax()) {
            $kpis = GLKPIGeneral::where("status", "wait")
                ->orderBy("id", "DESC")
                ->with("user")
                ->get();

            return DataTables::of($kpis)
                ->make(true);
        }

        $periodes = Periode::orderBy("id", "desc")
            ->get();
        $users = User::where("kategori", "GROUP LEADER")
            ->orderBy("id", "desc")
            ->get();

        return view('dashboard.gl_kpi_generals.check', compact("periodes", "countKPI", "countKPIGL", "users"));
    }

    public function approve(Request $request)
    {
        try {
            DB::beginTransaction();

            $kpi = GLKPIGeneral::with(['user', 'items', 'items.key_kamus', 'items.key_kamus.kamus'])
                ->find($request->id);

            /// Bikin file pdf ///
            // Subdivisi
            if ($kpi->subdivisi == "COMBEN") {
                $subdivisi = "Comben, Payroll, & PA";
                $path = "pdf.comben.gl_kpi_general_approve";
            } else if ($kpi->subdivisi == "REKRUT") {
                $subdivisi = "Rekrutmen";
                $path = "pdf.rekrut.gl_kpi_general_approve";
            } else if ($kpi->subdivisi == "TND") {
                $subdivisi = "Training & Development";
                $path = "pdf.tnd.gl_kpi_general_approve";
            } else {
                $subdivisi = "Industrial Relation";
                $path = "pdf.ir.gl_kpi_general_approve";
            }

            $title = "KPI Group Leader $subdivisi - {$kpi->periode}";

            // Data Section Head
            $section = User::where("KATEGORI", "SECTION")->first();

            // Data 3 GL
            $gl = User::where("kategori", "GROUP LEADER")
                ->where("subdivisi", $kpi->subdivisi)
                ->limit(3)
                ->get();

            $pdf = PDF::setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ])
                ->setPaper(array(0, 0, 609.449, 935.433), 'landscape');

            // Load HTML view
            $html = view($path, compact(['title', 'kpi', 'section', "gl"]))->render();

            // Load external CSS (Bootstrap)
            $cssFile = 'assets/vendor/bootstrap/css/bootstrap.min.css';
            $css = file_get_contents($cssFile);
            $html = "<style>$css</style>\n$html";

            // Load external JavaScript (Bootstrap)
            $jsFile = 'assets/vendor/bootstrap/js/bootstrap.bundle.min.js';
            $js = file_get_contents($jsFile);
            $html = "<script>$js</script>\n$html";

            $pdf->loadHtml($html);
            $pdf->render();

            // Simpan PDF
            $namePDF = uniqid() . uniqid() . "-" . random_int(000, 999) . ".pdf";
            $pdfPath = "storage/pdf/" . $namePDF;
            $pdf->save($pdfPath);
            /// End Bikin file pdf ///

            // Simpan KPI Approve
            GLKPIGeneralApprove::create([
                "id_kpi_general" => $kpi->id,
                "file" => $namePDF,
            ]);

            // Ubah KPI
            $kpi->update([
                "status" => "approve",
                "alasan" => NULL,
            ]);

            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "Berhasil approve kpi!",
            ]);
        } catch (QueryException $err) {
            DB::rollBack();

            return response()->json([
                "status" => "failed",
                "message" => "Gagal approve kpi!",
                "err" => $err
            ]);
        }
    }

    public function reject(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'alasan'            => 'required',
            ],
            [
                'alasan.required'   => 'Alasan harus diisi!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal reject kpi!",
                "errors" => $validation->errors(),
            ]);
        }

        try {
            $kpi = GLKPIGeneral::find($request->id);

            $kpi->update([
                "status" => "reject",
                "alasan" => $request->alasan,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil reject kpi!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal reject kpi!",
                "err" => $err,
            ]);
        }
    }

    public function store(Request $request, $subdivisi)
    {
        try {

            DB::beginTransaction();

            // Cek apakah user sudah mempunyai ttd
            $user = User::find($request->id_user);
            if (!$user->ttd) {
                return response()->json([
                    "status" => "failed",
                    "message" => "User ini harus memiliki tanda tangan!",
                ]);
            }

            // Buat KPI General
            if ($request->hasFile('file')) {

                $imgname = $request->file->hashName();
                $request->file->move('storage/file/', $imgname);

                $kpi = GLKPIGeneral::create([
                    'periode' => ucfirst($request->periode),
                    'id_user' => $request->id_user,
                    'total' => 0,
                    'subdivisi' => strtoupper($subdivisi),
                    'file' => $imgname,
                ]);
            } else {
                $kpi = GLKPIGeneral::create([
                    'periode' => ucfirst($request->periode),
                    'id_user' => $request->id_user,
                    'total' => 0,
                    'subdivisi' => strtoupper($subdivisi),
                ]);
            }

            // Ambil id KPI
            $id_kpi = $kpi->id;

            // Ambil request
            $data = $request->all();

            // Menghapus kunci "id_user" dan "periode" dari data
            unset($data["id_user"]);
            unset($data["periode"]);
            unset($data["file"]);

            foreach ($data as $item) {

                // No urut
                $no_urut = $item['no_urut'];

                foreach ($item['key_performance_indicators'] as $data) {
                    // Hitung skor akhir
                    $skor_akhir = (intval($data['skor']) * intval($data['bobot'])) / 100;

                    // Buat KPI Item
                    GLKPIGeneralItem::create([
                        "id_key_performance_indicator" => $data['id_key_performance_indicator'],
                        "realisasi" => $data['realisasi'],
                        "skor" => $data['skor'],
                        "konversi_sf" => $data['konversi_sf'],
                        "skor_akhir" => $skor_akhir,
                        "id_kpi_general" => $id_kpi,
                        "no_urut" => $no_urut,
                    ]);
                }
            }

            // Hitung Total KPI General
            $total = GLKPIGeneralItem::where("id_kpi_general", $id_kpi)->sum("skor_akhir");

            // Update Total Pada KPI General
            $kpi->update(["total" => $total]);

            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Berhasil tambah data kpi baru!",
            ]);
        } catch (QueryException $err) {
            DB::rollback();
            return response()->json([
                "status" => "failed",
                "message" => "Gagal tambah data kpi!",
                "errors" => $err,
            ]);
        }
    }

    public function edit($subdivisi, $id)
    {
        $dataUser = GLKPIGeneral::with(['user'])->find($id);
        $dataItems = GLKPIGeneral::with(['items', 'items.key_kamus'])->find($id);

        if ($dataUser && $dataItems) {
            // Gabungkan dataUser dan dataItems
            $data = $dataItems->toArray();
            $data['user'] = $dataUser->user->toArray();

            // Kelompokkan item berdasarkan no_urut
            $groupedItems = collect($data['items'])->groupBy('no_urut')->toArray();
            $data['items'] = $groupedItems;
        }

        // Kirim data sebagai respons JSON
        return response()->json([
            "status" => "success",
            "data" => $data,
        ]);
    }

    public function update($subdivisi, $id, Request $request)
    {

        try {

            DB::beginTransaction();

            $kpi = GLKPIGeneral::find($id);
            $fileKpi = $kpi->file;

            // Update kpi general
            $kpi->update([
                'periode' => ucfirst($request->periode),
                'id_user' => $request->id_user,
                'alasan' => null,
                'status' => "wait",
            ]);

            // Update file
            if ($request->hasFile('file')) {

                // Hapus file
                if ($fileKpi) {
                    $filePath = 'storage/file/' . $kpi->file;

                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }

                // Ubah foto
                $imgname = $request->file->hashName();
                $request->file->move('storage/file/', $imgname);

                $kpi->update([
                    'file' => $imgname,
                ]);
            }

            // Ambil request
            $data = $request->all();

            // Menghapus kunci "id_user" dan "periode" dari data
            unset($data["id_user"]);
            unset($data["periode"]);
            unset($data["_method"]);
            unset($data["file"]);

            foreach ($data as $item) {

                // No urut
                $no_urut = $item['no_urut'];

                foreach ($item['key_performance_indicators'] as $data) {
                    // Hitung skor akhir
                    $skor_akhir = (intval($data['skor']) * intval($data['bobot'])) / 100;

                    // Update KPI Items
                    GLKPIGeneralItem::where("id_kpi_general", $kpi->id)
                        ->where('id', $data['id'])
                        ->update([
                            "realisasi" => $data['realisasi'],
                            "skor" => $data['skor'],
                            "konversi_sf" => $data['konversi_sf'],
                            "skor_akhir" => $skor_akhir,
                        ]);
                }
            }

            // Hitung Total KPI General
            $total = GLKPIGeneralItem::where("id_kpi_general", $kpi->id)->sum("skor_akhir");

            // Update Total Pada KPI General
            $kpi->update(["total" => $total]);

            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Berhasil edit data kpi!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal edit data kpi!",
                "err" => $err
            ]);
        }
    }

    public function destroy($subdivisi, $id)
    {
        try {
            DB::beginTransaction();

            // Ambil KPI General
            $kpi = GLKPIGeneral::find($id);

            // Hapus semua KPI item
            GLKPIGeneralItem::where("id_kpi_general", $id)->delete();

            // Hapus file
            if ($kpi->file) {
                $filePath = 'storage/file/' . $kpi->file;

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Hapus kpi
            $kpi->delete();

            Db::commit();
            return response()->json([
                "status" => "success",
                "message" => "Berhasil hapus data!",
            ]);
        } catch (QueryException $err) {
            DB::rollBack();
            return response()->json([
                "status" => "failed",
                "message" => "Gagal hapus data!",
                "err" => $err
            ]);
        }
    }

    public function makePdf($id)
    {
        $kpi = GLKPIGeneral::with(['user', 'items', 'items.key_kamus', 'items.key_kamus.kamus'])
            ->where("id", $id)
            ->first();

        // Subdivisi
        if ($kpi->subdivisi == "COMBEN") {
            $subdivisi = "Comben, Payroll, & PA";
        } else if ($kpi->subdivisi == "REKRUT") {
            $subdivisi = "Rekrutmen";
        } else if ($kpi->subdivisi == "TND") {
            $subdivisi = "Training & Development";
        } else {
            $subdivisi = "Industrial Relation";
        }

        $title   = "KPI Group Leader $subdivisi - {$kpi->periode}";

        // Data Section Head
        $section = User::where("kategori", "SECTION")->first();

        // Data 3 GL
        $gl = User::where("kategori", "GROUP LEADER")
            ->where("subdivisi", $kpi->subdivisi)
            ->limit(3)
            ->get();

        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ])
            ->setPaper(array(0, 0, 609.449, 935.433), 'landscape');

        // Load HTML view
        if ($kpi->subdivisi == "COMBEN") {
            $html = view('pdf.comben.gl_kpi_general', compact(['title', 'kpi', 'section', 'gl']))->render();
        } else if ($kpi->subdivisi == "REKRUT") {
            $html = view('pdf.rekrut.gl_kpi_general', compact(['title', 'kpi', 'section', 'gl']))->render();
        } else if ($kpi->subdivisi == "TND") {
            $html = view('pdf.tnd.gl_kpi_general', compact(['title', 'kpi', 'section', 'gl']))->render();
        } else {
            $html = view('pdf.ir.gl_kpi_general', compact(['title', 'kpi', 'section', 'gl']))->render();
        }

        // Load external CSS (Bootstrap)
        $cssFile = 'assets/vendor/bootstrap/css/bootstrap.min.css';
        $css = file_get_contents($cssFile);
        $html = "<style>$css</style>\n$html";

        // Load external JavaScript (Bootstrap)
        $jsFile = 'assets/vendor/bootstrap/js/bootstrap.bundle.min.js';
        $js = file_get_contents($jsFile);
        $html = "<script>$js</script>\n$html";

        $pdf->loadHtml($html);
        $pdf->render();

        return $pdf->stream($title . "_" . random_int(00, 99) . ".pdf");
    }
}
