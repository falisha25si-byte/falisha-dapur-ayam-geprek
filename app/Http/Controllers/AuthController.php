<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Tampilkan form login (GET /auth).
     */
    public function index()
    {
        return view('guest.auth');
    }

    /**
     * Proses form login (POST /auth/login).
     *
     * Logika sederhana (sesuai soal):
     *  - username SAMA dengan password  -> ke Dashboard Admin
     *  - username BEDA dengan password  -> kembali ke Login + Alert
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if ($request->username === $request->password) {
            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil, selamat datang ' . $request->username . '!');
        }

        return redirect()->route('auth')
            ->withInput($request->only('username'))   // password sengaja tidak dikembalikan
            ->with('error', 'Username atau password salah!');
    }
}
