<?php

namespace App\Services;

use App\Models\AdminKPI;
use App\Models\GLKPI;

class BadgeService
{
    public function getCountKPIAdmin()
    {
        $user = auth()->user();

        if ($user->kategori == "MASTER") {
            return AdminKPI::where("status", "wait")->count();
        } elseif ($user->kategori == "GROUP LEADER") {
            return AdminKPI::where("subdivisi", $user->subdivisi)->where("status", "wait")->count();
        }

        return null;
    }

    public function getCountKPIGL()
    {
        $user = auth()->user();

        if ($user->kategori == "MASTER" || $user->kategori == "SECTION") {
            $comben = GLKPI::where("status", "wait")->where("subdivisi", "COMBEN")->count();
            $rekrut = GLKPI::where("status", "wait")->where("subdivisi", "REKRUT")->count();
            $tnd = GLKPI::where("status", "wait")->where("subdivisi", "TND")->count();
            $ir = GLKPI::where("status", "wait")->where("subdivisi", "IR")->count();

            return [
                "comben" => $comben,
                "rekrut" => $rekrut,
                "tnd" => $tnd,
                "ir" => $ir,
            ];
        }

        return null;
    }
}
