<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Pesan error validasi (Bahasa Indonesia).
     */
    private $pesan = [
        'required'  => ':attribute wajib diisi.',
        'string'    => ':attribute harus berupa teks.',
        'min'       => ':attribute minimal :min karakter.',
        'max'       => ':attribute maksimal :max karakter.',
        'email'     => 'Format :attribute tidak valid.',
        'unique'    => ':attribute sudah terdaftar.',
        'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    ];

    private $atribut = [
        'name'     => 'Nama',
        'email'    => 'Email',
        'password' => 'Password',
    ];

    /**
     * Tampilkan list data user.
     */
    public function index()
    {
        $data['dataUser'] = User::all();
        return view('admin.user.index', $data);
    }

    /**
     * Tampilkan form tambah user.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Simpan data user baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], $this->pesan, $this->atribut);

        try {
            $data['name']     = $request->name;
            $data['email']    = $request->email;
            $data['password'] = Hash::make($request->password); // password disimpan terenkripsi

            User::create($data);
        } catch (\Exception $e) {
            // error di luar validasi (mis. koneksi database) -> kembali ke form, isian tetap ada
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data user.');
        }

        return redirect()->route('user.index')->with('success', 'Penambahan Data User Berhasil!');
    }

    /**
     * Tidak dipakai, diarahkan ke list.
     */
    public function show(string $id)
    {
        return redirect()->route('user.index');
    }

    /**
     * Tampilkan form edit user.
     */
    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);
        return view('admin.user.edit', $data);
    }

    /**
     * Simpan perubahan data user.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            // email boleh sama dengan miliknya sendiri
            'email'    => 'required|email|unique:users,email,' . $id,
            // password opsional saat edit: kosong = password lama tidak diubah
            'password' => 'nullable|min:8|confirmed',
        ], $this->pesan, $this->atribut);

        $user = User::findOrFail($id);

        try {
            $user->name  = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan perubahan data user.');
        }

        return redirect()->route('user.index')->with('success', 'Perubahan Data User Berhasil!');
    }

    /**
     * Hapus data user.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Data User gagal dihapus.');
        }

        return redirect()->route('user.index')->with('success', 'Data User Berhasil Dihapus!');
    }
}
