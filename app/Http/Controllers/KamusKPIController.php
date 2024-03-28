<?php

namespace App\Http\Controllers;

use App\Imports\KamusImport;
use App\Models\Kamuskpi;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Services\BadgeService;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class KamusKPIController extends Controller
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
            if (Auth::user()->kategori == "MASTER" || Auth::user()->kategori == "SECTION") {
                $kamuss = Kamuskpi::orderBy("id", "DESC")->get();
            } else {
                $kamuss = Kamuskpi::where("subdivisi", Auth::user()->subdivisi)
                    ->where("kategori", Auth::user()->kategori)
                    ->orderBy("id", "DESC")
                    ->get();
            }
            return DataTables::of($kamuss)
                ->make(true);
        }

        return view('dashboard.kamus.index', compact("countKPI", "countKPIGL"));
    }

    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'pointkpi'        => 'required',
                'target'          => 'required',
                'unit_target'     => 'required',
            ],
            [
                'pointkpi.required'       => 'Point KPI harus diisi!',
                'target.required'         => 'Target harus diisi!',
                'unit_target.required'    => 'Unit Target harus diisi!',
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

            Kamuskpi::create([
                'pointkpi' => ucfirst($request->pointkpi),
                'subdivisi' => strtoupper($request->subdivisi),
                'target' => $request->target,
                'kategori' => $request->kategori,
                'unit_target' => ucfirst($request->unit_target),
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil tambah kamus baru!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal tambah kamus!",
            ]);
        }
    }

    public function edit($id)
    {
        $kamus = Kamuskpi::find($id);
        return response()->json([
            "status" => "success",
            "kamus" => $kamus,
        ]);
    }

    public function update(Kamuskpi $kamus, Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'pointkpi'        => 'required',
                'subdivisi'       => 'required',
                'target'          => 'required',
                'unit_target'     => 'required',
            ],
            [
                'pointkpi.required'       => 'Point KPI harus diisi!',
                'subdivisi.required'      => 'Subdivisi harus diisi!',
                'target.required'         => 'Target harus diisi!',
                'unit_target.required'    => 'Unit Target harus diisi!',
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
            $kamus->update([
                'pointkpi' => ucfirst($request->pointkpi),
                'subdivisi' => strtoupper($request->subdivisi),
                'target' => $request->target,
                'kategori' => $request->kategori,
                'unit_target' => ucfirst($request->unit_target),
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil edit kamus!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal edit kamus!",
                "err" => $err
            ]);
        }
    }

    public function destroy(Kamuskpi $kamus)
    {
        try {
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
            return [
                "target" => "",
                "unit_target" => "",
            ];
        } else {
            return Kamuskpi::where('id', $id_kamus)->first();
        }
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->hashName();

        // simpan file sementara
        $file->move('storage/export/', $nama_file);

        $filePath = 'storage/export/' . $nama_file;

        // import data
        $import = Excel::import(new KamusImport(), $filePath);

        // hapus file
        unlink($filePath);

        if ($import) {
            session()->flash("berhasil", "Berhasil import data kamus!");
        } else {
            session()->flash("gagal", "Terjadi kesalahan, Gagal import data kamus!");
        }
        return redirect("kamus");
    }
}
