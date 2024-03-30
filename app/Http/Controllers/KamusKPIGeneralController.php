<?php

namespace App\Http\Controllers;

use App\Models\KamusKPIGeneral;
use App\Models\KeyPerformanceIndicator;
use App\Services\BadgeService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class KamusKPIGeneralController extends Controller
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
                $kamuss = KamusKPIGeneral::with(['indicator_items'])
                    ->orderBy("subdivisi", "asc")
                    ->orderBy("baris", "asc")
                    ->get();
            } else if (Auth::user()->kategori == "SECTION") {
                $kamuss = KamusKPIGeneral::with(['indicator_items'])
                    ->orderBy("subdivisi", "asc")
                    ->orderBy("baris", "asc")
                    ->whereNotNull("baris")
                    ->get();
            } else {
                $kamuss = KamusKPIGeneral::with(['indicator_items'])
                    ->where("subdivisi", Auth::user()->subdivisi)
                    ->orderBy("baris", "asc")
                    ->whereNotNull("baris")
                    ->get();
            }
            return DataTables::of($kamuss)
                ->make(true);
        }

        return view('dashboard.kamus_general.index', compact("countKPI", "countKPIGL"));
    }

    public function store(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'area_kinerja_utama'          => 'required',
            ],
            [
                'area_kinerja_utama.required'          => 'Area Kinerja Utama harus diisi!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal tambah kamus!",
                "errors" => $validation->errors(),
            ]);
        }

        try {

            DB::beginTransaction();

            // Buat Kamus
            $kamus = KamusKPIGeneral::create([
                'area_kinerja_utama' => ucfirst($request->area_kinerja_utama),
                'subdivisi' => $request->subdivisi,
                'kategori' => $request->kategori,
            ]);

            /// Buat Key Performance Indicator Items ///

            // Ambil request
            $data = $request->all();

            // Ambil id kamus
            $idKamus = $kamus->id;

            // Menghapus kunci "area_kinerja_utama" dan "subdivisi" dari data
            unset($data["area_kinerja_utama"]);
            unset($data["subdivisi"]);
            unset($data["kategori"]);
            unset($data["baris"]);

            foreach ($data as $item) {
                // Buat Key Performance Indicator Items
                KeyPerformanceIndicator::create([
                    "id_kamus_general" => $idKamus,
                    "indicator" => $item['key_performance_indicators'],
                    "bobot" => $item['bobot'],
                    "target" => $item['target'],
                ]);
            }
            /// End Buat Key Performance Indicator Items ///

            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Berhasil tambah kamus baru!",
            ]);
        } catch (QueryException $err) {
            DB::rollBack();
            return response()->json([
                "status" => "failed",
                "message" => "Gagal tambah kamus!",
                "err" => $err->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $kamus = KamusKPIGeneral::with(['indicator_items'])
            ->find($id);

        return response()->json([
            "status" => "success",
            "kamus" => $kamus,
        ]);
    }

    public function update($id, Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'area_kinerja_utama'          => 'required',
            ],
            [
                'area_kinerja_utama.required'          => 'Area Kinerja Utama harus diisi!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal edit kamus!",
                "errors" => $validation->errors(),
            ]);
        }

        try {

            DB::beginTransaction();

            // Ambil kamus
            $kamus = KamusKPIGeneral::find($id);

            // Update kamus
            $kamus->update([
                'area_kinerja_utama' => ucfirst($request->area_kinerja_utama),
                'baris' => $request->baris,
                'kategori' => $request->kategori,
                'subdivisi' => $request->subdivisi,
            ]);

            /// Update Key Performance Indicator Items ///

            // Ambil request
            $data = $request->all();

            // Menghapus kunci "area_kinerja_utama" dan "subdivisi" dan "_method" dan "baris" dari data
            unset($data["area_kinerja_utama"]);
            unset($data["subdivisi"]);
            unset($data["kategori"]);
            unset($data["baris"]);
            unset($data["_method"]);

            // Ambil semua id indicator item
            $idValues = [];
            foreach ($data as $item) {
                if (isset($item['id'])) {
                    $idValues[] = $item['id'];
                }
            }

            // Hapus data yang tidak sesuai dengan $idValues
            KeyPerformanceIndicator::where("id_kamus_general", $kamus->id)
                ->whereNotIn('id', $idValues)
                ->delete();

            foreach ($data as $item) {
                // Update atau create Key Performance Indicator Items
                KeyPerformanceIndicator::updateOrCreate(
                    [
                        'id' => $item['id'],
                    ],
                    [
                        "id_kamus_general" => $kamus->id,
                        "indicator" => $item['key_performance_indicators'],
                        "bobot" => $item['bobot'],
                        "target" => $item['target'],
                    ]
                );
            }
            /// End Update Key Performance Indicator Items ///

            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Berhasil edit kamus!",
            ]);
        } catch (QueryException $err) {
            DB::rollBack();
            return response()->json([
                "status" => "failed",
                "message" => "Gagal edit kamus!",
                "err" => $err,
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $kamus = KamusKPIGeneral::find($id);
            $kamus->delete();

            return response()->json([
                "status" => "success",
                "message" => "Berhasil hapus kamus!",
            ]);
        } catch (QueryException $err) {
            $error = $err->getMessage();

            if (Str::startsWith($error, "SQLSTATE[23000]: Integrity constraint violation: 1451 Cannot delete or update a parent row")) {
                return response()->json([
                    "status" => "failed",
                    "message" => "Kamus tidak bisa dihapus, karena ada KPI yang memakai kamus ini!",
                ]);
            }

            return response()->json([
                "status" => "failed",
                "message" => "Gagal hapus kamus!",
                "err" => $err->getMessage()
            ]);
        }
    }

    public function getKamus($id_kamus)
    {
        if ($id_kamus == "null") {
            return [];
        } else {
            return KamusKPIGeneral::with(['indicator_items'])
                ->where('id', $id_kamus)
                ->first();
        }
    }
}
