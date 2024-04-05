<?php

namespace App\Http\Controllers;

use App\Models\GLKPIGeneral;
use App\Models\SectionKPIGeneral;
use App\Models\KamusKPIGeneral;
use App\Models\Periode;
use App\Models\SectionKPIGeneralCategoryGoalItem;
use App\Models\SectionKPIGeneralCategoryItem;
use App\Services\BadgeService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SectionKPIGeneralController extends Controller
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
            $kpis = SectionKPIGeneral::orderBy("id", "DESC")->get();

            return DataTables::of($kpis)->make(true);
        }

        // Kamus General Berdasarkan Cari Yang Aktif / Memiliki Baris
        $datakamus = KamusKPIGeneral::select("area_kinerja_utama")
            ->where("kategori", "GROUP LEADER")
            ->get();

        // Mengelompokkan data berdasarkan nama
        $groupedKamuss = $datakamus->groupBy('area_kinerja_utama')->toArray();

        // Mengonversi hasilnya menjadi array
        $kamuss = [];

        // Menghitung berapa kali setiap nama muncul
        $nameCounts = $datakamus->countBy('area_kinerja_utama');

        // Kamus dengan nama minimal 2 kali muncul
        foreach ($nameCounts as $nama => $count) {
            if ($count >= 2) {
                $kamuss[] = ['area_kinerja_utama' => $nama];
            }
        }

        $kamuss;

        $periodes = Periode::orderBy("id", "ASC")->get();

        return view('dashboard.section_kpi_generals.index', compact("countKPI", "countKPIGL", "kamuss", "periodes"));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $periode = "";

            // Ubah format periode awal dan akhir
            // Konversi tanggal ke objek Carbon
            $periode_awal = Carbon::parse($request->periode_awal);
            $periode_akhir = Carbon::parse($request->periode_akhir);

            // Ubah format tanggal menjadi "NamaBulan Tahun" (misal: "Januari 2024")
            $periode_awal_format = $periode_awal->translatedFormat('F');
            $periode_akhir_format = $periode_akhir->translatedFormat('F Y');

            $periode = $periode_awal_format . " - " . $periode_akhir_format;

            // Buat KPI General
            if ($request->hasFile('file')) {

                $filename = $request->file->hashName();
                $request->file->move('storage/file/', $filename);

                $kpiGeneral = SectionKPIGeneral::create([
                    'periode'       => $periode,
                    'periode_awal'  => $request->periode_awal,
                    'periode_akhir' => $request->periode_akhir,
                    'parameter' => $request->parameter,
                    'total'     => 0,
                    'file'      => $filename,
                ]);
            } else {
                $kpiGeneral = SectionKPIGeneral::create([
                    'periode'       => $periode,
                    'periode_awal'  => $request->periode_awal,
                    'periode_akhir' => $request->periode_akhir,
                    'parameter' => $request->parameter,
                    'total'     => 0,
                ]);
            }

            // Kategori (string) ubah jadi array - pisahkan kategori dengan goal
            $bsc_categories = [];
            $bsc_categories_temp = $request->bsc_categories;

            foreach ($bsc_categories_temp as $category) {
                $data = preg_split('/,(?=(?:[^"]|"[^"]*")*$)/', $category);
                $bsc_category = trim($data[0], '"');

                array_shift($data);

                $goal_temp = array_chunk($data, 5);
                $goals = [];

                foreach ($goal_temp as $goal_temp) {
                    $goal = [];
                    $goal["goal_name"]           = trim($goal_temp[0], '"');
                    $goal["metric_description"]  = trim($goal_temp[1], '"');
                    $goal["metric_scale"]        = trim($goal_temp[2], '"');
                    $goal["weight"]              = trim($goal_temp[3], '"');
                    $goal["filters"]             = helperArrayFilterKPI(trim(trim($goal_temp[4], '"'), "|"));

                    $goals[] = $goal;
                }

                $bsc_categories[] = [
                    "bsc_category" => $bsc_category,
                    "goals" => $goals
                ];
            }

            // Ambil id KPI
            $id_kpi = $kpiGeneral->id;
            $totalWeight = 0;
            $awal = $request->periode_awal;
            $akhir = $request->periode_akhir;

            // Bikin category item kpi
            foreach ($bsc_categories as $category) {

                $categoryKPI = SectionKPIGeneralCategoryItem::create([
                    "id_section_kpi" => $id_kpi,
                    "bsc_category"   => ucfirst(trim($category['bsc_category'], '"')),
                ]);

                // Ambil id category
                $id_category = $categoryKPI->id;

                // Bikin category goal item kpi
                foreach ($category['goals'] as $goal) {
                    // Hitung Total KPI General
                    $totalWeight += floatval(trim($goal['weight'], '"'));
                    $rata_rata_sf = 0;

                    // Hitung rata-rata penilaian atau konversi SF
                    $data_sf = [];
                    for ($index = 0; $index < count($goal['filters']); $index++) {

                        if ($goal['filters'][$index][0] == "ALL TEAM") {

                            // Untuk all team
                            $kpis = GLKPIGeneral::with(["items", "items.key_kamus", "items.key_kamus.kamus", "periode"])
                                ->where("status", "approve")
                                ->whereHas("periode", function ($query) use ($awal, $akhir) {
                                    $query->whereBetween("tanggal", [$awal, $akhir]);
                                })
                                ->get();

                            foreach ($kpis as $kpi) {
                                foreach ($kpi['items'] as $item) {
                                    if ($item["key_kamus"]["kamus"]["area_kinerja_utama"] == $goal['filters'][$index][2]) {
                                        $data_sf[] = $item["konversi_sf"];
                                    }
                                }
                            }
                        } else {

                            // Untuk yang mempunyai subdivisi
                            $kpis = GLKPIGeneral::with(["items", "items.key_kamus", "items.key_kamus.kamus", "periode"])
                                ->where("status", "approve")
                                ->where("subdivisi", $goal['filters'][$index][0])
                                ->whereHas("periode", function ($query) use ($awal, $akhir) {
                                    $query->whereBetween("tanggal", [$awal, $akhir]);
                                })
                                ->get();

                            foreach ($kpis as $kpi) {
                                foreach ($kpi['items'] as $item) {
                                    // Baris
                                    foreach ($goal['filters'][$index][1] as $baris) {
                                        if ($item["key_kamus"]["kamus"]["baris"] == $baris) {
                                            $data_sf[] = $item["konversi_sf"];
                                        }
                                    }
                                }
                            }
                        }
                    }

                    $total_sf  = array_sum($data_sf);
                    $jumlah_sf = count($data_sf);
                    if ($total_sf != 0) {
                        $rata_rata_sf = round($total_sf / $jumlah_sf, 2);
                    }

                    // Konversi bintang dari nilai sf
                    if ($rata_rata_sf > 110) {
                        $bintang = "Bintang 5";
                    } else if ($rata_rata_sf >= 101) {
                        $bintang = "Bintang 4";
                    } else if ($rata_rata_sf >= 91) {
                        $bintang = "Bintang 3";
                    } else if ($rata_rata_sf >= 80) {
                        $bintang = "Bintang 2";
                    } else {
                        $bintang = "Bintang 1";
                    }

                    SectionKPIGeneralCategoryGoalItem::create([
                        "id_category"          => $id_category,
                        "goal_name"            => ucfirst(trim($goal['goal_name'], '"')),
                        "metric_description"   => ucfirst(trim($goal['metric_description'], '"')),
                        "metric_scale"         => ucfirst(trim($goal['metric_scale'], '"')),
                        "weight"               => floatval(trim($goal['weight'], '"')),
                        "nilai_pencapaian_sf"  => $rata_rata_sf,
                        "konversi_bintang"     => $bintang,
                        "filters"              => json_encode($goal['filters']),
                    ]);
                }
            }

            // Update Total Pada KPI General
            $kpiGeneral->update(["total" => floatval($totalWeight)]);

            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Berhasil tambah data kpi baru!",
            ]);
        } catch (QueryException $err) {
            DB::rollback();
            return response()->json([
                "status" => "failed",
                "message" => "Gagal tambah data kpi!",
                "errors" => $err,
            ]);
        }
    }

    public function show($id)
    {
        $data = SectionKPIGeneral::with(['category_items', 'category_items.goal_items'])->find($id);

        // Kirim data sebagai respons JSON
        return response()->json([
            "status" => "success",
            "data"   => $data,
        ]);
    }

    public function edit($id)
    {
        $data = SectionKPIGeneral::with(['category_items', 'category_items.goal_items'])->find($id);

        // Kirim data sebagai respons JSON
        return response()->json([
            "status" => "success",
            "data"   => $data,
        ]);
    }

    public function update($id, Request $request)
    {

        try {

            DB::beginTransaction();

            $periode = "";

            // Ubah format periode awal dan akhir
            // Konversi tanggal ke objek Carbon
            $periode_awal = Carbon::parse($request->periode_awal);
            $periode_akhir = Carbon::parse($request->periode_akhir);

            // Ubah format tanggal menjadi "NamaBulan Tahun" (misal: "Januari 2024")
            $periode_awal_format = $periode_awal->translatedFormat('F');
            $periode_akhir_format = $periode_akhir->translatedFormat('F Y');

            $periode = $periode_awal_format . " - " . $periode_akhir_format;

            $kpi = SectionKPIGeneral::find($id);
            $fileKpi = $kpi->file;

            // Update kpi general
            $kpi->update([
                'periode'       => $periode,
                'periode_awal'  => $request->periode_awal,
                'periode_akhir' => $request->periode_akhir,
                'parameter' => $request->parameter,
            ]);

            // Update file
            if ($request->hasFile('file')) {

                // Hapus file
                if ($fileKpi) {
                    $filePath = 'storage/file/' . $kpi->file;

                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }

                // Ubah file
                $filename = $request->file->hashName();
                $request->file->move('storage/file/', $filename);

                $kpi->update([
                    'file' => $filename,
                ]);
            }

            // Kategori (string) ubah jadi array - pisahkan kategori dengan goal
            $bsc_categories = [];
            $bsc_categories_temp = $request->bsc_categories;

            foreach ($bsc_categories_temp as $category) {
                $data = preg_split('/,(?=(?:[^"]|"[^"]*")*$)/', $category);
                $bsc_category = trim($data[0], '"');

                array_shift($data);

                $goal_temp = array_chunk($data, 5);
                $goals = [];

                foreach ($goal_temp as $goal_temp) {
                    $goal = [];
                    $goal["goal_name"]           = trim($goal_temp[0], '"');
                    $goal["metric_description"]  = trim($goal_temp[1], '"');
                    $goal["metric_scale"]        = trim($goal_temp[2], '"');
                    $goal["weight"]              = trim($goal_temp[3], '"');
                    $goal["filters"]             = helperArrayFilterKPI(trim(trim($goal_temp[4], '"'), "|"));

                    $goals[] = $goal;
                }

                $bsc_categories[] = [
                    "bsc_category" => $bsc_category,
                    "goals" => $goals
                ];
            }

            // Hapus data kpi category lama
            SectionKPIGeneralCategoryItem::where("id_section_kpi", $kpi->id)->delete();

            $totalWeight = 0;
            $awal = $request->periode_awal;
            $akhir = $request->periode_akhir;

            // Update category item kpi
            foreach ($bsc_categories as $category) {

                // Bikin kpi category baru
                $categoryKPI = SectionKPIGeneralCategoryItem::create([
                    "id_section_kpi" => $kpi->id,
                    "bsc_category"   => ucfirst(trim($category['bsc_category'], '"')),
                ]);

                // Ambil id category
                $id_category = $categoryKPI->id;

                // Bikin category goal item kpi
                foreach ($category['goals'] as $goal) {
                    // Hitung Total KPI General
                    $totalWeight += floatval(trim($goal['weight'], '"'));
                    $rata_rata_sf = 0;

                    // Hitung rata-rata penilaian atau konversi SF
                    $data_sf = [];
                    for ($index = 0; $index < count($goal['filters']); $index++) {

                        if ($goal['filters'][$index][0] == "ALL TEAM") {

                            // Untuk all team
                            $kpi_generals = GLKPIGeneral::with(["items", "items.key_kamus", "items.key_kamus.kamus", "periode"])
                                ->where("status", "approve")
                                ->whereHas("periode", function ($query) use ($awal, $akhir) {
                                    $query->whereBetween("tanggal", [$awal, $akhir]);
                                })
                                ->get();

                            foreach ($kpi_generals as $kpi_general) {
                                foreach ($kpi_general['items'] as $item) {
                                    if ($item["key_kamus"]["kamus"]["area_kinerja_utama"] == $goal['filters'][$index][2]) {
                                        $data_sf[] = $item["konversi_sf"];
                                    }
                                }
                            }
                        } else {

                            // Untuk yang mempunyai subdivisi
                            $kpi_generals = GLKPIGeneral::with(["items", "items.key_kamus", "items.key_kamus.kamus", "periode"])
                                ->where("status", "approve")
                                ->where("subdivisi", $goal['filters'][$index][0])
                                ->whereHas("periode", function ($query) use ($awal, $akhir) {
                                    $query->whereBetween("tanggal", [$awal, $akhir]);
                                })
                                ->get();

                            foreach ($kpi_generals as $kpi_general) {
                                foreach ($kpi_general['items'] as $item) {
                                    // Baris
                                    foreach ($goal['filters'][$index][1] as $baris) {
                                        if ($item["key_kamus"]["kamus"]["baris"] == $baris) {
                                            $data_sf[] = $item["konversi_sf"];
                                        }
                                    }
                                }
                            }
                        }
                    }

                    $total_sf  = array_sum($data_sf);
                    $jumlah_sf = count($data_sf);
                    if ($total_sf != 0) {
                        $rata_rata_sf = round($total_sf / $jumlah_sf, 2);
                    }

                    // Konversi bintang dari nilai sf
                    if ($rata_rata_sf > 110) {
                        $bintang = "Bintang 5";
                    } else if ($rata_rata_sf >= 101) {
                        $bintang = "Bintang 4";
                    } else if ($rata_rata_sf >= 91) {
                        $bintang = "Bintang 3";
                    } else if ($rata_rata_sf >= 80) {
                        $bintang = "Bintang 2";
                    } else {
                        $bintang = "Bintang 1";
                    }

                    SectionKPIGeneralCategoryGoalItem::create([
                        "id_category"          => $id_category,
                        "goal_name"            => ucfirst(trim($goal['goal_name'], '"')),
                        "metric_description"   => ucfirst(trim($goal['metric_description'], '"')),
                        "metric_scale"         => ucfirst(trim($goal['metric_scale'], '"')),
                        "weight"               => floatval(trim($goal['weight'], '"')),
                        "nilai_pencapaian_sf"  => $rata_rata_sf,
                        "konversi_bintang"     => $bintang,
                        "filters"              => json_encode($goal['filters']),
                    ]);
                }
            }

            // Update Total Pada KPI General
            $kpi->update(["total" => floatval($totalWeight)]);

            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Berhasil edit data kpi!",
            ]);
        } catch (QueryException $err) {
            DB::rollback();
            return response()->json([
                "status" => "failed",
                "message" => "Gagal edit data kpi!",
                "err" => $err
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // Ambil KPI General
            $kpi = SectionKPIGeneral::find($id);

            // Hapus file
            if ($kpi->file) {
                $filePath = 'storage/file/' . $kpi->file;

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Hapus kpi
            $kpi->delete();

            Db::commit();
            return response()->json([
                "status" => "success",
                "message" => "Berhasil hapus data!",
            ]);
        } catch (QueryException $err) {
            DB::rollBack();
            return response()->json([
                "status" => "failed",
                "message" => "Gagal hapus data!",
                "err" => $err
            ]);
        }
    }

    public function makePdf($id)
    {
        $kpi = SectionKPIGeneral::with(['category_items', 'category_items.goal_items'])
            ->where("id", $id)
            ->first();

        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ])
            ->setPaper(array(0, 0, 609.449, 935.433), 'landscape');

        // Load HTML view
        $html = view('pdf.section.section_kpi_general', compact(['kpi']))->render();

        // Load external CSS (Bootstrap)
        $cssFile = 'assets/vendor/bootstrap/css/bootstrap.min.css';
        $css = file_get_contents($cssFile);
        $html = "<style>$css</style>\n$html";

        // Load external JavaScript (Bootstrap)
        $jsFile = 'assets/vendor/bootstrap/js/bootstrap.bundle.min.js';
        $js = file_get_contents($jsFile);
        $html = "<script>$js</script>\n$html";

        $pdf->loadHtml($html);
        $pdf->render();

        return $pdf->stream("KPI " . $kpi->tahun . " HCGA SITE (SH HC)_" . random_int(00, 99) . ".pdf");
    }
}
