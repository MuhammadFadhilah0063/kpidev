<?php

namespace App\Http\Controllers;

use App\Models\GLKPI;
use App\Models\GLKPIApprove;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Services\BadgeService;

class SectionController extends Controller
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

        $subdivisi = strtoupper(explode('/', $request->path())[1]);

        // Yajra DataTables
        if (request()->ajax()) {
            $individual_kpis = GLKPI::where("subdivisi", $subdivisi)
                ->where("status", 'wait')
                ->orderBy("id", "DESC")
                ->with("kamus", "user", "periode")
                ->get();
            return DataTables::of($individual_kpis)
                ->make(true);
        }

        $glUsers = User::where("kategori", "GROUP LEADER")->where("subdivisi", $subdivisi)->get();

        return view('dashboard.section.index', compact("countKPI", "countKPIGL", "glUsers"));
    }

    public function approve($subdivisi, Request $request)
    {
        try {
            DB::beginTransaction();

            $kpi = GLKPI::find($request->id);

            // Simpan KPI Approve
            GLKPIApprove::create([
                "id_kpi" => $kpi->id,
            ]);

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
            $kpi = GLKPI::find($request->id);

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
