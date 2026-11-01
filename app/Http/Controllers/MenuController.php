<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        'image'    => ':attribute harus berupa gambar.',
        'mimes'    => ':attribute harus berformat jpg, jpeg, png, atau webp.',
        'gambar.max' => 'Ukuran foto maksimal 2 MB.',
        'nama_menu.unique' => 'Menu dengan nama ini sudah ada, gunakan nama lain.',
    ];

    private $atribut = [
        'nama_menu'   => 'Nama menu',
        'kategori'    => 'Kategori',
        'harga'       => 'Harga',
        'level_pedas' => 'Level pedas',
        'deskripsi'   => 'Deskripsi',
        'status'      => 'Status',
        'gambar'      => 'Foto menu',
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
            // unique: nama menu tidak boleh dobel
            'nama_menu'   => 'required|max:100|unique:menu,nama_menu',
            'kategori'    => 'required|in:Ayam Geprek,Paket Hemat,Minuman,Tambahan',
            'harga'       => 'required|numeric|min:1000',
            'level_pedas' => 'required|integer|between:0,5',
            'deskripsi'   => 'nullable|max:500',
            'status'      => 'required|in:Tersedia,Habis',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], $this->pesan, $this->atribut);

        $data['nama_menu']   = $request->nama_menu;
        $data['kategori']    = $request->kategori;
        $data['harga']       = $request->harga;
        $data['level_pedas'] = $request->level_pedas;
        $data['deskripsi']   = $request->deskripsi;
        $data['status']      = $request->status;

        // upload foto -> storage/app/public/menu (diakses lewat public/storage)
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('menu', 'public');
        }

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
            // unique, kecuali milik menu ini sendiri
            'nama_menu'   => 'required|max:100|unique:menu,nama_menu,' . $id . ',menu_id',
            'kategori'    => 'required|in:Ayam Geprek,Paket Hemat,Minuman,Tambahan',
            'harga'       => 'required|numeric|min:1000',
            'level_pedas' => 'required|integer|between:0,5',
            'deskripsi'   => 'nullable|max:500',
            'status'      => 'required|in:Tersedia,Habis',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], $this->pesan, $this->atribut);

        $menu = Menu::findOrFail($id);

        $menu->nama_menu   = $request->nama_menu;
        $menu->kategori    = $request->kategori;
        $menu->harga       = $request->harga;
        $menu->level_pedas = $request->level_pedas;
        $menu->deskripsi   = $request->deskripsi;
        $menu->status      = $request->status;

        // ganti foto: hapus foto lama, simpan foto baru
        if ($request->hasFile('gambar')) {
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $menu->gambar = $request->file('gambar')->store('menu', 'public');
        }

        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Perubahan Data Menu Berhasil!');
    }

    /**
     * Hapus data menu.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);

        // hapus file foto dari storage
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }

        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Data Menu Berhasil Dihapus!');
    }
}
