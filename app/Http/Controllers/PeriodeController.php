<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use App\Services\BadgeService;

class PeriodeController extends Controller
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
            $periodes = Periode::orderBy("id", "DESC")->get();
            return DataTables::of($periodes)
                ->make(true);
        }

        $periodes = Periode::orderBy("id", "desc")->get();
        return view('dashboard.periode.index', compact("periodes", "countKPI", "countKPIGL"));
    }

    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'periode'          => 'unique:periodes|required',
            ],
            [
                'periode.unique'    => 'Periode sudah ada!',
                'periode.required'    => 'Periode harus diisi!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal tambah periode!",
                "errors" => $validation->errors(),
            ]);
        }

        try {

            // Pisah bulan dan tahun dan buat jadi tanggal real
            $tanggal = explodeBulanDanTahun($request->periode);

            Periode::create([
                'periode' => ucfirst($request->periode),
                'tanggal' => $tanggal,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil tambah periode baru!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal tambah periode!",
            ]);
        }
    }

    public function edit($id)
    {
        $periode = Periode::find($id);
        return response()->json([
            "status" => "success",
            "periode" => $periode,
        ]);
    }

    public function update(periode $periode, Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'periode'          => [
                    Rule::unique('periodes')->ignore($periode->id),
                    'required'
                ],
            ],
            [
                'periode.unique'    => 'Periode sudah ada!',
                'periode.required'    => 'Periode harus diisi!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal edit periode!",
                "errors" => $validation->errors(),
            ]);
        }

        try {

            // Pisah bulan dan tahun dan buat jadi tanggal real
            $tanggal = explodeBulanDanTahun($request->periode);

            $periode->update([
                'periode' => ucfirst($request->periode),
                'tanggal' => $tanggal,
            ]);

            return response()->json([
                "status" => "success",
                "message" => "Berhasil edit periode!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal edit periode!",
                "err" => $err
            ]);
        }
    }

    public function destroy(periode $periode)
    {
        try {
            $periode->delete();

            return response()->json([
                "status" => "success",
                "message" => "Berhasil hapus periode!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal hapus periode!",
                "err" => $err
            ]);
        }
    }
}
