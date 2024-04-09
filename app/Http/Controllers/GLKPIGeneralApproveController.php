<?php

namespace App\Http\Controllers;

use App\Models\GLKPIGeneral;
use App\Models\GLKPIGeneralApprove;
use App\Models\Periode;
use App\Models\User;
use App\Services\BadgeService;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class GLKPIGeneralApproveController extends Controller
{
    protected $badgeService;

    public function __construct(BadgeService $badgeService)
    {
        $this->badgeService = $badgeService;
    }

    public function index()
    {
        // Badge KPI Admin Menunggu Approve
        $countKPI = $this->badgeService->getCountKPIAdmin();

        // Badge GL KPI Menunggu Approve Pada Section
        $countKPIGL = $this->badgeService->getCountKPIGL();

        // Yajra DataTables
        if (request()->ajax()) {

            if (Auth::user()->kategori == "MASTER") {
                $kpis = GLKPIGeneral::where("status", "approve")
                    ->orderBy("id", "DESC")
                    ->with(["user", "periode"])
                    ->get();
            } else {
                $kpis = GLKPIGeneral::where("status", "approve")
                    ->where("subdivisi", Auth::user()->subdivisi)
                    ->orderBy("id", "DESC")
                    ->with(["user", "periode"])
                    ->get();
            }

            return DataTables::of($kpis)->make(true);
        }

        // Periodes
        $periodes = Periode::orderBy("tanggal", "ASC")->get();

        if (Auth::user()->subdivisi) {
            $subdivisi = Auth::user()->subdivisi;
            $glUsers = User::where("kategori", "GROUP LEADER")->where('subdivisi', $subdivisi)->get();
        } else {
            $subdivisi = "";
            $glUsers = User::where("kategori", "GROUP LEADER")->get();
        }

        return view('dashboard.gl_kpi_general_approve.index', compact("subdivisi", "countKPI", "countKPIGL", "glUsers", "periodes"));
    }
}
