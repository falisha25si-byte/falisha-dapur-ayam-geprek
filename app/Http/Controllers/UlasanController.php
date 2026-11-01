<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Ulasan;
use Illuminate\Http\Request;

/**
 * CRUD Ulasan menggunakan ELOQUENT ORM.
 * Data diolah lewat Model (Ulasan, Menu, Pelanggan) dan relasinya.
 */
class UlasanController extends Controller
{
    private $pesan = [
        'required'        => ':attribute wajib diisi.',
        'exists'          => ':attribute yang dipilih tidak terdaftar.',
        'integer'         => ':attribute harus berupa angka bulat.',
        'between'         => ':attribute harus antara :min sampai :max.',
        'min'             => ':attribute minimal :min karakter.',
        'max'             => ':attribute maksimal :max karakter.',
        'date'            => ':attribute harus berupa tanggal.',
        'before_or_equal' => ':attribute tidak boleh melebihi hari ini.',
    ];

    private $atribut = [
        'pelanggan_id'   => 'Pelanggan',
        'menu_id'        => 'Menu',
        'rating'         => 'Rating',
        'komentar'       => 'Komentar',
        'tanggal_ulasan' => 'Tanggal ulasan',
    ];

    private $aturan = [
        'pelanggan_id'   => 'required|exists:pelanggan,pelanggan_id',
        'menu_id'        => 'required|exists:menu,menu_id',
        'rating'         => 'required|integer|between:1,5',
        'komentar'       => 'required|min:5|max:500',
        'tanggal_ulasan' => 'required|date|before_or_equal:today',
    ];

    /**
     * List ulasan + pencarian & filter.
     */
    public function index(Request $request)
    {
        // Eager loading relasi (with) supaya tidak terjadi N+1 query
        $data['dataUlasan'] = Ulasan::with(['pelanggan', 'menu'])
            // pencarian di kolom sendiri ATAU di tabel relasi (nested where + whereHas)
            ->when($request->cari, function ($query, $cari) {
                $query->where(function ($q) use ($cari) {
                    $q->where('komentar', 'like', "%{$cari}%")
                      ->orWhereHas('pelanggan', fn ($p) => $p->where('nama_pelanggan', 'like', "%{$cari}%"))
                      ->orWhereHas('menu', fn ($m) => $m->where('nama_menu', 'like', "%{$cari}%"));
                });
            })
            ->when($request->rating, fn ($query, $rating) => $query->where('rating', $rating))
            ->orderByDesc('tanggal_ulasan')
            ->paginate(10)
            ->withQueryString();

        return view('admin.ulasan.index', $data);
    }

    /**
     * Form tambah ulasan (dropdown pelanggan & menu dari tabel relasi).
     */
    public function create()
    {
        $data['dataPelanggan'] = Pelanggan::orderBy('nama_pelanggan')->get();
        $data['dataMenu']      = Menu::orderBy('nama_menu')->get();

        return view('admin.ulasan.create', $data);
    }

    /**
     * Simpan ulasan baru -> Model::create() (mass assignment, timestamps otomatis).
     */
    public function store(Request $request)
    {
        $request->validate($this->aturan, $this->pesan, $this->atribut);

        try {
            $data = $request->only(['pelanggan_id', 'menu_id', 'rating', 'komentar', 'tanggal_ulasan']);
            $data['tampil'] = $request->boolean('tampil');

            Ulasan::create($data);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan ulasan.');
        }

        return redirect()->route('ulasan.index')->with('success', 'Penambahan Data Ulasan Berhasil!');
    }

    public function show(string $id)
    {
        return redirect()->route('ulasan.index');
    }

    /**
     * Form edit ulasan.
     */
    public function edit(string $id)
    {
        $data['dataUlasan']    = Ulasan::findOrFail($id);
        $data['dataPelanggan'] = Pelanggan::orderBy('nama_pelanggan')->get();
        $data['dataMenu']      = Menu::orderBy('nama_menu')->get();

        return view('admin.ulasan.edit', $data);
    }

    /**
     * Simpan perubahan -> $model->update().
     */
    public function update(Request $request, string $id)
    {
        $request->validate($this->aturan, $this->pesan, $this->atribut);

        $ulasan = Ulasan::findOrFail($id);

        try {
            $data = $request->only(['pelanggan_id', 'menu_id', 'rating', 'komentar', 'tanggal_ulasan']);
            $data['tampil'] = $request->boolean('tampil');

            $ulasan->update($data);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan perubahan ulasan.');
        }

        return redirect()->route('ulasan.index')->with('success', 'Perubahan Data Ulasan Berhasil!');
    }

    /**
     * Hapus ulasan -> $model->delete().
     */
    public function destroy(string $id)
    {
        $ulasan = Ulasan::findOrFail($id);

        try {
            $ulasan->delete();
        } catch (\Exception $e) {
            return redirect()->route('ulasan.index')->with('error', 'Data Ulasan gagal dihapus.');
        }

        return redirect()->route('ulasan.index')->with('success', 'Data Ulasan Berhasil Dihapus!');
    }
}
