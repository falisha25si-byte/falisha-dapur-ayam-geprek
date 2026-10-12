<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Pesan error validasi (Bahasa Indonesia).
     */
    private $pesan = [
        'required' => ':attribute wajib diisi.',
        'max'      => ':attribute maksimal :max karakter.',
        'in'       => ':attribute yang dipilih tidak valid.',
        'numeric'  => ':attribute harus berupa angka.',
        'integer'  => ':attribute harus berupa angka bulat.',
        'harga.min'   => 'Harga minimal Rp 1.000.',
        'level_pedas.between' => 'Level pedas harus antara 0 sampai 5.',
    ];

    private $atribut = [
        'nama_menu'   => 'Nama menu',
        'kategori'    => 'Kategori',
        'harga'       => 'Harga',
        'level_pedas' => 'Level pedas',
        'deskripsi'   => 'Deskripsi',
        'status'      => 'Status',
    ];

    /**
     * Tampilkan list data menu.
     */
    public function index()
    {
        $data['dataMenu'] = Menu::all();
        return view('admin.menu.index', $data);
    }

    /**
     * Tampilkan form tambah menu.
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Simpan data menu baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu'   => 'required|max:100',
            'kategori'    => 'required|in:Ayam Geprek,Paket Hemat,Minuman,Tambahan',
            'harga'       => 'required|numeric|min:1000',
            'level_pedas' => 'required|integer|between:0,5',
            'deskripsi'   => 'nullable|max:500',
            'status'      => 'required|in:Tersedia,Habis',
        ], $this->pesan, $this->atribut);

        $data['nama_menu']   = $request->nama_menu;
        $data['kategori']    = $request->kategori;
        $data['harga']       = $request->harga;
        $data['level_pedas'] = $request->level_pedas;
        $data['deskripsi']   = $request->deskripsi;
        $data['status']      = $request->status;

        Menu::create($data);

        return redirect()->route('menu.index')->with('success', 'Penambahan Data Menu Berhasil!');
    }

    /**
     * Tidak dipakai, diarahkan ke list.
     */
    public function show(string $id)
    {
        return redirect()->route('menu.index');
    }

    /**
     * Tampilkan form edit menu.
     */
    public function edit(string $id)
    {
        $data['dataMenu'] = Menu::findOrFail($id);
        return view('admin.menu.edit', $data);
    }

    /**
     * Simpan perubahan data menu.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_menu'   => 'required|max:100',
            'kategori'    => 'required|in:Ayam Geprek,Paket Hemat,Minuman,Tambahan',
            'harga'       => 'required|numeric|min:1000',
            'level_pedas' => 'required|integer|between:0,5',
            'deskripsi'   => 'nullable|max:500',
            'status'      => 'required|in:Tersedia,Habis',
        ], $this->pesan, $this->atribut);

        $menu = Menu::findOrFail($id);

        $menu->nama_menu   = $request->nama_menu;
        $menu->kategori    = $request->kategori;
        $menu->harga       = $request->harga;
        $menu->level_pedas = $request->level_pedas;
        $menu->deskripsi   = $request->deskripsi;
        $menu->status      = $request->status;

        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Perubahan Data Menu Berhasil!');
    }

    /**
     * Hapus data menu.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);

        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Data Menu Berhasil Dihapus!');
    }
}
