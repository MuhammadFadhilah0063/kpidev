<?php

namespace App\Http\Controllers;

use App\Models\GLKPIGeneralApprove;
use App\Models\Periode;
use App\Models\User;
use App\Services\BadgeService;
use Illuminate\Http\Request;
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

            if (Auth::user()->subdivisi) {
                $kpis = GLKPIGeneralApprove::with(["kpi", "kpi.user"])
                    ->whereHas('kpi', function ($query) {
                        $query->where('subdivisi', Auth::user()->subdivisi);
                        $query->where('id_user', Auth::user()->id);
                    })
                    ->latest()
                    ->get();
            } else {
                $kpis = GLKPIGeneralApprove::with(["kpi", "kpi.user"])
                    ->latest()
                    ->get();
            }

            return DataTables::of($kpis)->make(true);
        }

        // Periodes
        $periodes = Periode::get();

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
