<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Pesan error validasi (Bahasa Indonesia).
     */
    private $pesan = [
        'required'       => ':attribute wajib diisi.',
        'min'            => ':attribute minimal :min karakter.',
        'max'            => ':attribute maksimal :max karakter.',
        'in'             => ':attribute yang dipilih tidak valid.',
        'numeric'        => ':attribute harus berupa angka.',
        'digits_between' => ':attribute harus :min sampai :max digit.',
        'email'          => 'Format :attribute tidak valid.',
        'unique'         => ':attribute sudah terdaftar.',
        'date'           => ':attribute harus berupa tanggal.',
        'before'         => ':attribute harus sebelum hari ini.',
    ];

    private $atribut = [
        'nama_pelanggan' => 'Nama pelanggan',
        'jenis_kelamin'  => 'Jenis kelamin',
        'no_hp'          => 'No. HP',
        'email'          => 'Email',
        'tanggal_lahir'  => 'Tanggal lahir',
        'alamat'         => 'Alamat',
    ];

    /**
     * Tampilkan list data pelanggan.
     */
    public function index()
    {
        $data['dataPelanggan'] = Pelanggan::all();
        return view('admin.pelanggan.index', $data);
    }

    /**
     * Tampilkan form tambah pelanggan.
     */
    public function create()
    {
        return view('admin.pelanggan.create');
    }

    /**
     * Simpan data pelanggan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|min:3|max:100',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'no_hp'          => 'required|numeric|digits_between:10,15',
            'email'          => 'required|email|unique:pelanggan,email',
            'tanggal_lahir'  => 'nullable|date|before:today',
            'alamat'         => 'nullable|max:255',
        ], $this->pesan, $this->atribut);

        $data['nama_pelanggan'] = $request->nama_pelanggan;
        $data['jenis_kelamin']  = $request->jenis_kelamin;
        $data['no_hp']          = $request->no_hp;
        $data['email']          = $request->email;
        $data['tanggal_lahir']  = $request->tanggal_lahir;
        $data['alamat']         = $request->alamat;

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Pelanggan Berhasil!');
    }

    /**
     * Tidak dipakai, diarahkan ke list.
     */
    public function show(string $id)
    {
        return redirect()->route('pelanggan.index');
    }

    /**
     * Tampilkan form edit pelanggan.
     */
    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }

    /**
     * Simpan perubahan data pelanggan.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|min:3|max:100',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'no_hp'          => 'required|numeric|digits_between:10,15',
            // email boleh sama dengan miliknya sendiri
            'email'          => 'required|email|unique:pelanggan,email,' . $id . ',pelanggan_id',
            'tanggal_lahir'  => 'nullable|date|before:today',
            'alamat'         => 'nullable|max:255',
        ], $this->pesan, $this->atribut);

        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->nama_pelanggan = $request->nama_pelanggan;
        $pelanggan->jenis_kelamin  = $request->jenis_kelamin;
        $pelanggan->no_hp          = $request->no_hp;
        $pelanggan->email          = $request->email;
        $pelanggan->tanggal_lahir  = $request->tanggal_lahir;
        $pelanggan->alamat         = $request->alamat;

        $pelanggan->save();

        return redirect()->route('pelanggan.index')->with('success', 'Perubahan Data Pelanggan Berhasil!');
    }

    /**
     * Hapus data pelanggan.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data Pelanggan Berhasil Dihapus!');
    }
}
