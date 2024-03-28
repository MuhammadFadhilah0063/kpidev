<?php

namespace App\Http\Controllers;

use App\Models\GLKPI;
use App\Models\Kamuskpi;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Services\BadgeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class GLKPIController extends Controller
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
                $kpis = GLKPI::where("subdivisi", $subdivisi)
                    ->whereNot("status", "approve")
                    ->orderBy("id", "DESC")
                    ->with("kamus", "user")
                    ->get();
            } else {
                $kpis = GLKPI::where("subdivisi", $subdivisi)
                    ->where("id_user", Auth::user()->id)
                    ->whereNot("status", "approve")
                    ->orderBy("id", "DESC")
                    ->with("kamus", "user")
                    ->get();
            }

            return DataTables::of($kpis)
                ->make(true);
        }

        $kamuss = Kamuskpi::where("subdivisi", $subdivisi)
            ->where("kategori", "GROUP LEADER")
            ->orderBy("id", "desc")
            ->get();

        $periodes = Periode::orderBy("id", "desc")->get();

        if (Auth::user()->kategori == "MASTER") {
            $users = User::where("kategori", "GROUP LEADER")->where("subdivisi", $subdivisi)->get();
            return view('dashboard.gl_kpi.index', compact("kamuss", "periodes", "subdivisi", "countKPI", "countKPIGL", "users"));
        }

        return view('dashboard.gl_kpi.index', compact("kamuss", "periodes", "subdivisi", "countKPI", "countKPIGL"));
    }

    public function store(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'aktual_realisasi'   => 'required',
                'pencapaian_sf'      => 'required|numeric',
                'id_kamus'           => 'required',
            ],
            [
                'aktual_realisasi.required'    => 'Aktual realisasi harus diisi!',
                'pencapaian_sf.required'       => 'Pencapaian SF harus diisi!',
                'pencapaian_sf.numeric'        => 'Pencapaian SF harus diisi angka. Angka desimal pakai "." bukan ","!',
                'id_kamus.required'            => 'Point harus diisi!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal tambah data!",
                "errors" => $validation->errors(),
            ]);
        }

        try {
            if ($request->hasFile('file')) {

                $imgname = $request->file->hashName();
                $request->file->move('storage/file/', $imgname);

                GLKPI::create([
                    'periode' => ucfirst($request->periode),
                    'id_kamus' => $request->id_kamus,
                    'id_user' => $request->id_user,
                    'aktual_realisasi' => $request->aktual_realisasi,
                    'pencapaian_sf' => $request->pencapaian_sf,
                    'subdivisi' => strtoupper($request->subdivisi),
                    'file' => $imgname,
                ]);
            } else {
                GLKPI::create([
                    'periode' => ucfirst($request->periode),
                    'id_kamus' => $request->id_kamus,
                    'id_user' => $request->id_user,
                    'aktual_realisasi' => $request->aktual_realisasi,
                    'pencapaian_sf' => $request->pencapaian_sf,
                    'subdivisi' => strtoupper($request->subdivisi),
                ]);
            }

            return response()->json([
                "status" => "success",
                "message" => "Berhasil tambah data baru!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal tambah data!",
                "errors" => $err,
            ]);
        }
    }

    public function edit($subdivisi, $id)
    {
        $data = GLKPI::find($id);
        return response()->json([
            "status" => "success",
            "data" => $data,
        ]);
    }

    public function update($subdivisi, $id, Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'aktual_realisasi'   => 'required',
                'pencapaian_sf'      => 'required|numeric',
                'id_kamus'           => 'required',
            ],
            [
                'aktual_realisasi.required'    => 'Aktual realisasi harus diisi!',
                'pencapaian_sf.required'       => 'Pencapaian SF harus diisi!',
                'pencapaian_sf.numeric'        => 'Pencapaian SF harus diisi angka. Angka desimal pakai "." bukan ","!',
                'id_kamus.required'            => 'Point harus diisi!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal edit data!",
                "errors" => $validation->errors(),
            ]);
        }

        try {
            $kpi = GLKPI::find($id);
            $fileKpi = $kpi->file;

            $kpi->update([
                'periode' => ucfirst($request->periode),
                'id_kamus' => $request->id_kamus,
                'id_user' => $request->id_user,
                'aktual_realisasi' => $request->aktual_realisasi,
                'pencapaian_sf' => $request->pencapaian_sf,
                'subdivisi' => strtoupper($request->subdivisi),
                'status' => 'wait',
                'alasan' => NULL,
            ]);

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

            return response()->json([
                "status" => "success",
                "message" => "Berhasil edit data!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal edit data!",
                "err" => $err
            ]);
        }
    }

    public function destroy($subdivisi, $id)
    {
        try {
            $kpi = GLKPI::find($id);

            // Hapus file
            if ($kpi->file) {
                $filePath = 'storage/file/' . $kpi->file;

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $kpi->delete();

            return response()->json([
                "status" => "success",
                "message" => "Berhasil hapus data!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal hapus data!",
                "err" => $err
            ]);
        }
    }
}
