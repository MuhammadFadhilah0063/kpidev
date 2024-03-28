<?php

namespace App\Http\Controllers;

use App\Models\AdminKPI;
use App\Models\GLKPI;
use Illuminate\Support\Facades\Session;
use App\Services\BadgeService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $badgeService;

    public function __construct(BadgeService $badgeService)
    {
        $this->badgeService = $badgeService;
    }

    public function index()
    {
        // Badge KPI Admin Menunggu Approve Pada Pemeriksaan KPI Admin
        $countKPI = $this->badgeService->getCountKPIAdmin();

        // Badge GL KPI Menunggu Approve Pada Section
        $countKPIGL = $this->badgeService->getCountKPIGL();

        $subdivisis = ["COMBEN", "REKRUT", "TND", "IR"];

        // KPI Admin
        $jumlahKPIAdminStatusWait = [];
        foreach ($subdivisis as $subdivisi) {
            if (Auth::user()->kategori == "ADMIN" && Auth::user()->subdivisi) {
                $jumlah = AdminKPI::where('subdivisi', $subdivisi)
                    ->where('id_user', Auth::user()->id)
                    ->where("status", "wait")
                    ->count();
            } else {
                $jumlah = AdminKPI::where('subdivisi', $subdivisi)
                    ->where("status", "wait")
                    ->count();
            }
            $jumlahKPIAdminStatusWait[$subdivisi] = $jumlah;
        }

        // KPI GL
        $jumlahKPIGLStatusWait = [];
        foreach ($subdivisis as $subdivisi) {
            if (Auth::user()->subdivisi) {
                $jumlah = GLKPI::where('subdivisi', $subdivisi)
                    ->where('id_user', Auth::user()->id)
                    ->where("status", "wait")
                    ->count();
            } else {
                $jumlah = GLKPI::where('subdivisi', $subdivisi)
                    ->where("status", "wait")
                    ->count();
            }
            $jumlahKPIGLStatusWait[$subdivisi] = $jumlah;
        }

        return view("dashboard.index", compact('countKPI', 'countKPIGL', 'jumlahKPIAdminStatusWait', 'jumlahKPIGLStatusWait'));
    }

    public function clearSessionLogin()
    {
        // Hapus sesi di sisi server
        Session::forget('login');
        return response()->json(["status" => "success"]);
    }
}
