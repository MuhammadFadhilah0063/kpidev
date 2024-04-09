<?php

namespace App\Http\Controllers;

use App\Models\GLKPI;
use App\Models\GLKPIApprove;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Services\BadgeService;

class GLKPIApproveController extends Controller
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
                $kpis = GLKPI::where("subdivisi", Auth::user()->subdivisi)
                    ->where("status", "approve")
                    ->orderBy("id", "DESC")
                    ->with("kamus", "user", "periode")
                    ->get();
            } else {
                $kpis = GLKPI::where("status", "approve")
                    ->orderBy("id", "DESC")
                    ->with("kamus", "user", "periode")
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


        return view('dashboard.gl_kpi_approve.index', compact("subdivisi", "countKPI", "countKPIGL", "glUsers", "periodes"));
    }
}
