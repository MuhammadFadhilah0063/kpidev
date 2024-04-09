<?php

namespace App\Http\Controllers;

use App\Models\AdminKPIGeneral;
use App\Models\AdminKPIGeneralApprove;
use App\Models\Periode;
use App\Models\User;
use App\Services\BadgeService;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdminKPIGeneralApproveController extends Controller
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
                if (Auth::user()->kategori == "ADMIN") {
                    $kpis = AdminKPIGeneral::where("subdivisi", Auth::user()->subdivisi)
                        ->where("status", "approve")
                        ->where("id_user", Auth::user()->id)
                        ->orderBy("id", "DESC")
                        ->with("user")
                        ->get();
                } else {
                    $kpis = AdminKPIGeneral::where("subdivisi", Auth::user()->subdivisi)
                        ->where("status", "approve")
                        ->orderBy("id", "DESC")
                        ->with("user")
                        ->get();
                }
            } else {
                $kpis = AdminKPIGeneral::where("status", "approve")
                    ->orderBy("id", "DESC")
                    ->with("user")
                    ->get();
            }

            return DataTables::of($kpis)->make(true);
        }

        // Periodes
        $periodes = Periode::get();

        if (Auth::user()->subdivisi) {
            $subdivisi = Auth::user()->subdivisi;
            $glUsers = User::where("kategori", "ADMIN")->where('subdivisi', $subdivisi)->get();
        } else {
            $subdivisi = "";
            $glUsers = User::where("kategori", "ADMIN")->get();
        }

        return view('dashboard.admin_kpi_general_approve.index', compact("subdivisi", "countKPI", "countKPIGL", "glUsers", "periodes"));
    }
}
