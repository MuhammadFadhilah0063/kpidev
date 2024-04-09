<?php

namespace App\Http\Controllers;

use App\Models\AdminKPI;
use App\Models\AdminKPIApprove;
use App\Models\Kamuskpi;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Services\BadgeService;
use Illuminate\Support\Facades\Auth;

class AdminKPIController extends Controller
{
    protected $badgeService;

    public function __construct(BadgeService $badgeService)
    {
        $this->badgeService = $badgeService;
    }

    public function index(Request $request)
    {
        $subdivisi = strtoupper(explode('/', $request->path())[2]);

        // Yajra DataTables
        if (request()->ajax()) {
            $kpis = AdminKPI::where("subdivisi", $subdivisi)
                ->where("id_user", Auth::user()->id)
                ->orderBy("id", "DESC")
                ->with("kamus")
                ->get();
            return DataTables::of($kpis)
                ->make(true);
        }

        $kamuss = Kamuskpi::where("subdivisi", $subdivisi)
            ->where("kategori", Auth::user()->kategori)
            ->orderBy("id", "desc")
            ->get();

        $periodes = Periode::orderBy("id", "desc")->get();

        return view('dashboard.admin_kpi.index', compact("kamuss", "periodes", "subdivisi"));
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

                AdminKPI::create([
                    'periode' => ucfirst($request->periode),
                    'id_kamus' => $request->id_kamus,
                    'id_user' => $request->id_user,
                    'aktual_realisasi' => $request->aktual_realisasi,
                    'pencapaian_sf' => $request->pencapaian_sf,
                    'subdivisi' => strtoupper($request->subdivisi),
                    'file' => $imgname,
                ]);
            } else {
                AdminKPI::create([
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
        $data = AdminKPI::find($id);
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
            $kpi = AdminKPI::find($id);
            $fileKpi = $kpi->file;

            if ($kpi->status == "reject") {
                $status = "wait";
            } else {
                $status = $kpi->status;
            }

            $kpi->update([
                'periode' => ucfirst($request->periode),
                'id_kamus' => $request->id_kamus,
                'id_user' => $request->id_user,
                'aktual_realisasi' => $request->aktual_realisasi,
                'pencapaian_sf' => $request->pencapaian_sf,
                'subdivisi' => strtoupper($request->subdivisi),
                'status' => $status,
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
            $kpi = AdminKPI::find($id);

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

    public function checkKPI(Request $request)
    {
        // Badge KPI Admin Menunggu Approve
        $countKPI = $this->badgeService->getCountKPIAdmin();

        // Badge GL KPI Menunggu Approve Pada Section
        $countKPIGL = $this->badgeService->getCountKPIGL();

        $subdivisi = strtoupper(explode('/', $request->path())[2]);

        // Yajra DataTables
        if (request()->ajax()) {

            if ($subdivisi == "SEMUA-SUBDIVISI") {
                $kpis = AdminKPI::where("status", "wait")->orderBy("id", "DESC")->with("kamus", "user")->get();
            } else {
                $kpis = AdminKPI::where("subdivisi", $subdivisi)->where("status", "wait")->orderBy("id", "DESC")->with("kamus", "user")->get();
            }
            return DataTables::of($kpis)
                ->make(true);
        }

        $adminUsers = User::where("kategori", "ADMIN")->where('subdivisi', $subdivisi)->get();

        if ($subdivisi == "SEMUA-SUBDIVISI") {
            $subdivisi = "";
            $adminUsers = User::where("kategori", "ADMIN")->get();
        }

        return view('dashboard.admin_kpi.check', compact("subdivisi", "countKPI", "countKPIGL", "adminUsers"));
    }

    public function approve($subdivisi, Request $request)
    {
        try {
            DB::beginTransaction();

            $kpi = AdminKPI::find($request->id);

            $kpi->update([
                "status" => "approve",
                "alasan" => NULL,
            ]);

            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "Berhasil approve data!",
            ]);
        } catch (QueryException $err) {
            DB::rollBack();

            return response()->json([
                "status" => "failed",
                "message" => "Gagal approve data!",
                "err" => $err
            ]);
        }
    }

    public function reject($subdivisi, Request $request)
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
                "message" => "Gagal reject data!",
                "errors" => $validation->errors(),
            ]);
        }

        try {
            $kpi = AdminKPI::find($request->id);

            $kpi->update([
                "status" => "reject",
                "alasan" => $request->alasan,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil reject data!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal reject data!",
                "err" => $err
            ]);
        }
    }


    public function destroyOnGL($subdivisi, $id)
    {
        try {
            $kpi = AdminKPI::find($id);

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
