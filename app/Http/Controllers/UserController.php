<?php

namespace App\Http\Controllers;

use App\Services\BadgeService;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
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
            $users = User::orderBy("id", "DESC")->get();
            return DataTables::of($users)
                ->make(true);
        }

        return view('dashboard.user.index', compact("countKPI", "countKPIGL"));
    }

    public function profile()
    {
        // Badge KPI Admin Menunggu Approve
        $countKPI = $this->badgeService->getCountKPIAdmin();

        // Badge GL KPI Menunggu Approve Pada Section
        $countKPIGL = $this->badgeService->getCountKPIGL();

        return view('dashboard.user.profile', compact("countKPI", "countKPIGL"));
    }

    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'nrp'          => 'unique:users|required',
                'nama'          => 'required',
                'password'          => 'required',
            ],
            [
                'nrp.unique'    => 'NRP sudah ada!',
                'nrp.required'    => 'NRP harus diisi!',
                'nama.required'    => 'Nama harus diisi!',
                'password.required'    => 'Password harus diisi!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal tambah user!",
                "errors" => $validation->errors(),
            ]);
        }

        try {
            if ($request->hasFile('foto_profil')) {

                $imgname = $request->foto_profil->hashName();
                $request->foto_profil->move('storage/foto_profil/', $imgname);

                User::create([
                    'nrp' => $request->nrp,
                    'nama' => $request->nama,
                    'kategori' => $request->kategori,
                    'subdivisi' => $request->subdivisi,
                    'password' => Hash::make(trim($request->password)),
                    'ttd' => 'default.png',
                    'foto_profil' => $imgname,
                ]);
            } else {
                User::create([
                    'nrp' => $request->nrp,
                    'nama' => $request->nama,
                    'kategori' => $request->kategori,
                    'subdivisi' => $request->subdivisi,
                    'password' => Hash::make(trim($request->password)),
                    'ttd' => 'default.png',
                ]);
            }

            return response()->json([
                "status" => "success",
                "message" => "Berhasil tambah user baru!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal tambah user!",
            ]);
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json([
            "status" => "success",
            "user" => $user,
        ]);
    }

    public function update(User $user, Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'nrp'          => [
                    Rule::unique('users')->ignore($user->id),
                    'required'
                ],
                'nama'          => 'required',
            ],
            [
                'nrp.unique'    => 'NRP sudah ada!',
                'nrp.required'    => 'NRP harus diisi!',
                'nama.required'    => 'Nama harus diisi!',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal edit user!",
                "errors" => $validation->errors(),
            ]);
        }

        try {
            if ($request->password_lama != null && $request->password_baru != null) {

                if (Hash::check($request->password_lama, $user->password)) {
                    $user->update([
                        'nrp' => $request->nrp,
                        'nama' => $request->nama,
                        'kategori' => $request->kategori,
                        'subdivisi' => $request->subdivisi,
                        'password' => Hash::make(trim($request->password_baru)),
                    ]);
                } else {
                    return response()->json([
                        "status" => "failed",
                        "message" => "Gagal edit user, password lama salah!",
                        "errors" => [
                            "password_lama" => ["Password lama salah"],
                        ]
                    ]);
                }
            } else {
                $user->update([
                    'nrp' => $request->nrp,
                    'nama' => $request->nama,
                    'kategori' => $request->kategori,
                    'subdivisi' => $request->subdivisi,
                ]);
            }

            if ($request->hasFile('foto_profil')) {

                // Hapus foto
                if ($user->foto_profil && $user->foto_profil != "default.png") {
                    $filePath = 'storage/foto_profil/' . $user->foto_profil;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }

                // Ubah foto
                $imgname = $request->foto_profil->hashName();
                $request->foto_profil->move('storage/foto_profil/', $imgname);

                $user->update([
                    'foto_profil' => $imgname,
                ]);
            }

            return response()->json([
                "status" => "success",
                "message" => "Berhasil edit user!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal edit user!",
                "err" => $err
            ]);
        }
    }

    public function destroy(User $user)
    {
        try {
            // Hapus foto
            if ($user->foto_profil && $user->foto_profil != "default.png") {
                $filePath = 'storage/foto_profil/' . $user->foto_profil;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $user->delete();

            return response()->json([
                "status" => "success",
                "message" => "Berhasil hapus user!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal hapus user!",
                "err" => $err
            ]);
        }
    }

    public function update_ttd(User $user, Request $request)
    {

        try {

            if ($request->hasFile('ttd')) {

                // Hapus ttd
                if ($user->ttd && $user->ttd != "default.png") {
                    $filePath = 'storage/ttd/' . $user->ttd;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }

                // Ubah ttd
                $imgname = $request->ttd->hashName();
                $request->ttd->move('storage/ttd/', $imgname);

                $user->update([
                    'ttd' => $imgname,
                ]);
            }

            return response()->json([
                "status" => "success",
                "message" => "Berhasil edit tanda tangan!",
            ]);
        } catch (QueryException $err) {
            return response()->json([
                "status" => "failed",
                "message" => "Gagal edit tanda tangan!",
                "err" => $err
            ]);
        }
    }
}
