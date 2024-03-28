<?php

namespace App\Http\Controllers;

use App\Models\AdminKPIApprove;
use App\Models\User;
use App\Services\BadgeService;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdminKPIApproveController extends Controller
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
                $kpis = AdminKPIApprove::with(["kpi", "kpi.kamus", "kpi.user"])
                    ->latest()
                    ->get();
            } else if (Auth::user()->kategori == "GROUP LEADER") {
                $kpis = AdminKPIApprove::with(["kpi", "kpi.kamus", "kpi.user"])
                    ->whereHas('kpi', function ($query) {
                        $query->where('subdivisi', Auth::user()->subdivisi);
                    })
                    ->latest()
                    ->get();
            } else {
                $kpis = AdminKPIApprove::with(["kpi", "kpi.kamus", "kpi.user"])
                    ->whereHas('kpi', function ($query) {
                        $query->where('subdivisi', Auth::user()->subdivisi);
                        $query->where('id_user', Auth::user()->id);
                    })
                    ->latest()
                    ->get();
            }

            return DataTables::of($kpis)->make(true);
        }

        if (Auth::user()->subdivisi) {
            $subdivisi = Auth::user()->subdivisi;
            $adminUsers = User::where("kategori", "ADMIN")->where('subdivisi', $subdivisi)->get();
        } else {
            $subdivisi = "";
            $adminUsers = User::where("kategori", "ADMIN")->get();
        }

        return view('dashboard.admin_kpi_approve.index', compact("subdivisi", "countKPI", "countKPIGL", "adminUsers"));
    }
}
