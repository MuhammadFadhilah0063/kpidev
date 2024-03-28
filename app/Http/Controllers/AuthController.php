<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view("login.index");
    }

    public function auth(Request $request)
    {
        try {
            $nrp = $request->nrp;
            $password = $request->password;

            if (Auth::attempt(['nrp' => $nrp, 'password' => $password])) {
                // Berhasil
                session(["login" => true]);
                return response()->json([
                    "status"  => "success",
                ]);
            } else {
                // Gagal
                return response()->json([
                    "status"  => "failed",
                    "message" => "NRP atau password salah!",
                ]);
            }
        } catch (Exception $e) {
            // Error
            return response()->json([
                "status"  => "error",
                "message" => "Error pada sistem!",
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(["status" => "success"]);
    }
}
