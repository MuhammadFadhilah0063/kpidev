<?php

namespace App\Http\Controllers;

use App\Models\GLKPI;
use App\Models\GLKPIBulanan;
use App\Models\GLKPIBulananItem;
use App\Models\Kamuskpi;
use App\Models\Periode;
use App\Models\User;
use App\Services\BadgeService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GLKPIBulananController extends Controller
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

        // Yajra DataTables
        if (request()->ajax()) {

            if (Auth::user()->kategori == "MASTER" || Auth::user()->kategori == "SECTION") {
                $kpis = GLKPIBulanan::with(["periode", "user"])
                    ->orderBy("id", "DESC")
                    ->get();
            } else {
                $kpis = GLKPIBulanan::with(["periode", "user"])
                    ->where("id_user", Auth::user()->id)
                    ->orderBy("id", "DESC")
                    ->get();
            }

            return DataTables::of($kpis)
                ->make(true);
        }

        $periodes = Periode::orderBy("id", "ASC")->get();

        if (Auth::user()->kategori == "MASTER" || Auth::user()->kategori == "SECTION") {
            $users = User::where("kategori", "GROUP LEADER")->get();
            return view('dashboard.gl_kpi_bulanan.index', compact("periodes", "countKPI", "countKPIGL", "users"));
        }

        return view('dashboard.gl_kpi_bulanan.index', compact("periodes", "countKPI", "countKPIGL"));
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            // Buat KPI Bulanan
            $kpibulanan = GLKPIBulanan::create([
                "id_user"   => $request->id_user,
                "id_periode" => $request->periode
            ]);

            // Goals (string) ubah jadi array - pisahkan goal
            $data = preg_split('/,(?=(?:[^"]|"[^"]*")*$)/', $request->points);
            $goal_temp = array_chunk($data, 1);
            $goals = [];

            foreach ($goal_temp as $goal) {
                $data = [];
                $data["id_kamus"]        = trim($goal[0], '"');

                $goals[] = $data;
            }

            // Buat item rekap
            foreach ($goals as $goal) {
                $rata_rata_pencapaian_sf = 0;

                // Hitung rata-rata pencapaian sf
                $kpi = GLKPI::select("pencapaian_sf")
                    ->where("status", "approve")
                    ->with("periode")
                    ->where("id_user", $request->id_user)
                    ->where("id_kamus", $goal["id_kamus"])
                    ->where("id_periode", $request->periode)
                    ->get();

                $jumlahkpi = $kpi->count();
                $jumlah = 0;
                foreach ($kpi as $item) {
                    $jumlah += (float) $item->pencapaian_sf;
                }

                if ($jumlahkpi != 0) {
                    $rata_rata_pencapaian_sf = round(($jumlah / $jumlahkpi), 2);
                }

                // Konversi bintang dari rata2 nilai sf
                if ($rata_rata_pencapaian_sf > 110) {
                    $bintang = "Bintang 5";
                } else if ($rata_rata_pencapaian_sf >= 101) {
                    $bintang = "Bintang 4";
                } else if ($rata_rata_pencapaian_sf >= 91) {
                    $bintang = "Bintang 3";
                } else if ($rata_rata_pencapaian_sf >= 80) {
                    $bintang = "Bintang 2";
                } else {
                    $bintang = "Bintang 1";
                }

                // Ambil realisasi
                $kpiRealisasi = GLKPI::select("realisasi")
                    ->where("status", "approve")
                    ->with("periode")
                    ->where("id_user", $request->id_user)
                    ->where("id_kamus", $goal["id_kamus"])
                    ->where("id_periode", $request->periode)
                    ->first();

                GLKPIBulananItem::create([
                    "id_kpi_bulanan"           => $kpibulanan->id,
                    "id_kamus"                 => $goal["id_kamus"],
                    "realisasi"                => $kpiRealisasi->realisasi,
                    "konversi_sf"              => $rata_rata_pencapaian_sf,
                    "konversi_bintang"         => $bintang,
                ]);
            }

            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Berhasil tambah data baru!",
            ]);
        } catch (QueryException $err) {

            DB::rollback();
            return response()->json([
                "status"  => "failed",
                "message" => "Gagal tambah data!",
                "errors"  => $err,
            ]);
        }
    }

    public function edit($id)
    {
        $data = GLKPIBulanan::with(["items", "user", "items.kamus", "periode"])->find($id);

        return response()->json([
            "status"    => "success",
            "data"      => $data,
        ]);
    }

    public function update($id, Request $request)
    {

        try {
            DB::beginTransaction();

            // Ambil KPI dan ubah datanya
            $kpibulanan = GLKPIBulanan::find($id);
            $kpibulanan->update([
                "id_periode" => $request->periode
            ]);

            // Hapus Items KPI
            GLKPIBulananItem::where("id_kpi_bulanan", $kpibulanan->id)->delete();

            // Goals (string) ubah jadi array - pisahkan goal
            $data = preg_split('/,(?=(?:[^"]|"[^"]*")*$)/', $request->points);
            $goal_temp = array_chunk($data, 1);
            $goals = [];

            foreach ($goal_temp as $goal) {
                $data = [];
                $data["id_kamus"]        = trim($goal[0], '"');

                $goals[] = $data;
            }

            // Buat item rekap
            foreach ($goals as $goal) {
                $rata_rata_pencapaian_sf = 0;

                // Hitung rata-rata pencapaian sf
                $kpi = GLKPI::select("pencapaian_sf")
                    ->where("status", "approve")
                    ->with("periode")
                    ->where("id_user", $request->id_user)
                    ->where("id_kamus", $goal["id_kamus"])
                    ->where("id_periode", $request->periode)
                    ->get();

                $jumlahkpi = $kpi->count();
                $jumlah = 0;
                foreach ($kpi as $item) {
                    $jumlah += (float) $item->pencapaian_sf;
                }

                if ($jumlahkpi != 0) {
                    $rata_rata_pencapaian_sf = round(($jumlah / $jumlahkpi), 2);
                }

                // Konversi bintang dari rata2 nilai sf
                if ($rata_rata_pencapaian_sf > 110) {
                    $bintang = "Bintang 5";
                } else if ($rata_rata_pencapaian_sf >= 101) {
                    $bintang = "Bintang 4";
                } else if ($rata_rata_pencapaian_sf >= 91) {
                    $bintang = "Bintang 3";
                } else if ($rata_rata_pencapaian_sf >= 80) {
                    $bintang = "Bintang 2";
                } else {
                    $bintang = "Bintang 1";
                }

                // Ambil realisasi
                $kpiRealisasi = GLKPI::select("realisasi")
                    ->where("status", "approve")
                    ->with("periode")
                    ->where("id_user", $request->id_user)
                    ->where("id_kamus", $goal["id_kamus"])
                    ->where("id_periode", $request->periode)
                    ->first();

                GLKPIBulananItem::create([
                    "id_kpi_bulanan"           => $kpibulanan->id,
                    "id_kamus"                 => $goal["id_kamus"],
                    "realisasi"                => $kpiRealisasi->realisasi,
                    "konversi_sf"              => $rata_rata_pencapaian_sf,
                    "konversi_bintang"         => $bintang,
                ]);
            }

            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Berhasil update data baru!",
            ]);
        } catch (QueryException $err) {

            DB::rollback();
            return response()->json([
                "status"  => "failed",
                "message" => "Gagal update data!",
                "errors"  => $err,
            ]);
        }
    }

    public function destroy($id)
    {
        try {

            // Delete kpi dan itemnya
            GLKPIBulananItem::where("id_kpi_bulanan", $id)->delete();
            GLKPIBulanan::find($id)->delete();

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

    public function getPoint(Request $request)
    {

        // Ambil data KPI
        $kpis = GLKPI::where("id_user", $request->id_user)
            ->where("status", "approve")
            ->where("id_periode", $request->periode)
            ->with(["kamus", "periode"])
            ->get();

        // Loop melalui setiap entri KPI dan mengambil poin KPI dan id kamus
        $pointkpis_temp = [];
        foreach ($kpis as $kpi) {
            $pointkpis_temp[] = [
                "point" => $kpi->kamus->pointkpi,
                "id_kamus" => $kpi->kamus->id,
            ];
        }

        // Menghapus duplikat berdasarkan nilai dan tipe data
        $pointkpis = array_values(array_unique($pointkpis_temp, SORT_REGULAR));

        return response()->json([
            "status" => "success",
            "data"   => $pointkpis
        ]);
    }
}
