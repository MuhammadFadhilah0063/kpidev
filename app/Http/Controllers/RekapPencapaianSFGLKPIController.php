<?php

namespace App\Http\Controllers;

use App\Models\GLKPI;
use App\Models\Kamuskpi;
use App\Models\Periode;
use App\Models\RekapPencapaianSFGLKPI;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Services\BadgeService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class RekapPencapaianSFGLKPIController extends Controller
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
                $kpis = RekapPencapaianSFGLKPI::with(["user"])
                    ->orderBy("id", "DESC")
                    ->get();
            } else {
                $kpis = RekapPencapaianSFGLKPI::with(["user"])
                    ->where("id_user", Auth::user()->id)
                    ->orderBy("id", "DESC")
                    ->get();
            }

            return DataTables::of($kpis)
                ->make(true);
        }

        $periodes = Periode::orderBy("id", "desc")->get();
        if (Auth::user()->kategori == "GROUP LEADER") {
            $points = Kamuskpi::where("kategori", "GROUP LEADER")->where("subdivisi", Auth::user()->subdivisi)->get();
        } else {
            $points = Kamuskpi::where("kategori", "GROUP LEADER")->get();
        }

        $periodeSelect = Periode::get();

        if (Auth::user()->kategori == "MASTER" || Auth::user()->kategori == "SECTION") {
            $users = User::where("kategori", "GROUP LEADER")->get();
            return view('dashboard.rekap_pencapaian_sf_gl_kpi.index', compact("periodes", "countKPI", "countKPIGL", "points", "users", "periodeSelect"));
        }

        // Ambil data KPI
        $kpis = GLKPI::where("id_user", Auth::user()->id)
            ->where("status", "approve")
            ->with(["kamus", "periode"])
            ->get();

        // Loop melalui setiap entri KPI dan mengambil poin KPI
        $pointkpis_temp = [];
        foreach ($kpis as $kpi) {
            $pointkpis_temp[] = $kpi->kamus->pointkpi;
        }

        $pointkpis = array_unique($pointkpis_temp);

        return view('dashboard.rekap_pencapaian_sf_gl_kpi.index', compact("periodes", "countKPI", "countKPIGL", "points", "pointkpis", "periodeSelect"));
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            // Goals (string) ubah jadi array - pisahkan goal
            $data = preg_split('/,(?=(?:[^"]|"[^"]*")*$)/', $request->points);
            $goal_temp = array_chunk($data, 3);
            $goals = [];

            foreach ($goal_temp as $goal) {
                $data = [];
                $data["point_kpi"]       = trim($goal[0], '"');
                $data["periode_awal"]    = trim($goal[1], '"');
                $data["periode_akhir"]   = trim($goal[2], '"');

                $goals[] = $data;
            }

            // Buat item rekap
            foreach ($goals as $goal) {
                $rata_rata_pencapaian_sf = 0;

                // Ambil data id kamus
                $kamus = Kamuskpi::select("id")
                    ->where("pointkpi", $goal['point_kpi'])
                    ->first();

                // Nilai periode awal dan akhir
                $awal = $goal['periode_awal'];
                $akhir = $goal['periode_akhir'];

                // Hitung rata-rata pencapaian sf
                $kpi = GLKPI::select("pencapaian_sf")
                    ->where("status", "approve")
                    ->with("periode")
                    ->where("id_user", $request->id_user)
                    ->where("id_kamus", $kamus->id)
                    ->whereHas('periode', function ($query) use ($awal, $akhir) {
                        $query->whereBetween('tanggal', [$awal, $akhir]);
                    })
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

                // Ubah format periode awal dan akhir
                // Konversi tanggal ke objek Carbon
                $periode_awal = Carbon::parse($awal);
                $periode_akhir = Carbon::parse($akhir);

                // Ubah format tanggal menjadi "NamaBulan Tahun" (misal: "Januari 2024")
                $periode_awal_format = $periode_awal->translatedFormat('F Y');
                $periode_akhir_format = $periode_akhir->translatedFormat('F Y');

                RekapPencapaianSFGLKPI::create([
                    "id_user"                  => $request->id_user,
                    "id_kamus"                 => $kamus->id,
                    "point_kpi"                => $goal['point_kpi'],
                    "periode"                  => $periode_awal_format . " - " . $periode_akhir_format,
                    "rata_rata_pencapaian_sf"  => $rata_rata_pencapaian_sf,
                    "konversi_bintang"         => $bintang,
                ]);
            }

            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Berhasil tambah data baru!",
            ]);
        } catch (Exception $err) {

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
        $data = RekapPencapaianSFGLKPI::with(["kamus"])->find($id);

        function convertMonthRangeToArray($monthRange)
        {
            $dataPeriode = explode(" - ", $monthRange);
            $periode = [];

            // Konversi nama bulan menjadi nomor bulan
            $monthNumber = [
                'Januari' => '01',
                'Februari' => '02',
                'Maret' => '03',
                'April' => '04',
                'Mei' => '05',
                'Juni' => '06',
                'Juli' => '07',
                'Agustus' => '08',
                'September' => '09',
                'Oktober' => '10',
                'November' => '11',
                'Desember' => '12'
            ];

            foreach ($dataPeriode as $item) {
                $data = explode(" ", $item);
                $periode[] = $data[1] . "-" . $monthNumber[$data[0]] . "-01";
            }

            return $periode;
        }

        return response()->json([
            "status"    => "success",
            "data"      => $data,
            "periodes"   => convertMonthRangeToArray($data->periode)
        ]);
    }

    public function update($id, Request $request)
    {

        try {
            $rekap = RekapPencapaianSFGLKPI::find($id);
            $rata_rata_pencapaian_sf = 0;

            // Nilai periode awal dan akhir
            $awal = $request->periode_awal_edit;
            $akhir = $request->periode_akhir_edit;

            // Hitung rata-rata pencapaian sf
            $kpi = GLKPI::select("pencapaian_sf", "id_periode")
                ->with("periode")
                ->where("status", "approve")
                ->where("id_user", $rekap->id_user)
                ->where("id_kamus", $rekap->id_kamus)
                ->whereHas('periode', function ($query) use ($awal, $akhir) {
                    $query->whereBetween('tanggal', [$awal, $akhir]);
                })
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

            // Ubah format periode awal dan akhir
            // Konversi tanggal ke objek Carbon
            $periode_awal = Carbon::parse($awal);
            $periode_akhir = Carbon::parse($akhir);

            // Ubah format tanggal menjadi "NamaBulan Tahun" (misal: "Januari 2024")
            $periode_awal_format = $periode_awal->translatedFormat('F Y');
            $periode_akhir_format = $periode_akhir->translatedFormat('F Y');

            $rekap->update([
                "periode"                  => $periode_awal_format . " - " . $periode_akhir_format,
                "rata_rata_pencapaian_sf"  => $rata_rata_pencapaian_sf,
                "konversi_bintang"         => $bintang,
            ]);

            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Berhasil edit data!",
            ]);
        } catch (QueryException $err) {

            DB::rollback();
            return response()->json([
                "status" => "failed",
                "message" => "Gagal edit data!",
                "err" => $err
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $kpi = RekapPencapaianSFGLKPI::find($id);
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

    // public function getKpiPeriodes(Request $request)
    // {
    //     // Ambil data id kamus
    //     $kamus = Kamuskpi::select("id")
    //         ->where("pointkpi", $request->point)
    //         ->first();

    //     // Ambil data KPI
    //     $kpis = GLKPI::where("id_user", $request->user)
    //         ->where("id_kamus", $kamus->id)
    //         ->where("status", "approve")
    //         ->with(["kamus", "periode"])
    //         ->orderBy("id", "DESC")
    //         ->get();

    //     // Loop melalui setiap entri KPI dan mengambil poin KPI
    //     $periodes_temp = [];
    //     foreach ($kpis as $kpi) {
    //         $periodes_temp[] = $kpi->periode;
    //     }

    //     $periodes = array_unique($periodes_temp);

    //     return response()->json([
    //         "status" => "success",
    //         "data"   => [
    //             "periodes"  => $periodes,
    //             "id_select" => $request->id_select
    //         ]
    //     ]);
    // }
}
