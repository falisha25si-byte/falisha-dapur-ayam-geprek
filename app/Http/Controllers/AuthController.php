<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tujuan setelah login sesuai role:
     * Admin -> Dashboard admin, Pelanggan -> halaman Guest.
     */
    private function halamanAwal()
    {
        return Auth::user()->role === 'Admin'
            ? redirect()->intended(route('dashboard'))
            : redirect()->route('home');
    }

    // ================= LOGIN =================

    /**
     * Tampilkan form login (GET /login).
     * Sudah login -> langsung diarahkan ke halaman sesuai role.
     */
    public function index()
    {
        if (Auth::check()) {
            return $this->halamanAwal();
        }

        return view('auth.login');
    }

    /**
     * Proses login (POST /login).
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // data tambahan di session (terpisah dari status login)
            session(['last_login' => now()->format('d M Y H:i')]);

            return $this->halamanAwal()
                ->with('success', 'Login berhasil! Selamat datang, ' . Auth::user()->name . ' (' . Auth::user()->role . ').');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    /**
     * Logout (POST /logout): hapus session lalu buat token CSRF baru.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }

    // ================= REGISTER (khusus Pelanggan) =================

    /**
     * Tampilkan form registrasi (GET /register).
     */
    public function registerForm()
    {
        if (Auth::check()) {
            return $this->halamanAwal();
        }

        return view('auth.register');
    }

    /**
     * Proses registrasi (POST /register).
     * Role TIDAK diambil dari form: user baru selalu menjadi Pelanggan.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'name.max'           => 'Nama maksimal 100 karakter.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $data['name']     = $request->name;
        $data['email']    = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['role']     = 'Pelanggan'; // role otomatis

        User::create($data);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login dengan akun baru Anda.')
            ->withInput(['email' => $request->email]);
    }

    // ================= LUPA PASSWORD =================

    /**
     * Tampilkan form lupa password (GET /lupa-password).
     */
    public function forgotForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Reset password dengan password baru (POST /lupa-password).
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.exists'       => 'Email tidak terdaftar.',
            'password.required'  => 'Password baru wajib diisi.',
            'password.min'       => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')
            ->with('success', 'Password berhasil diubah. Silakan login dengan password baru.')
            ->withInput(['email' => $request->email]);
    }
}
