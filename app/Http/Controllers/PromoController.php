<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * CRUD Promo menggunakan QUERY BUILDER (DB::table).
 * Tidak memakai Model: query ditulis langsung ke tabel, relasi diambil dengan join / leftJoin.
 */
class PromoController extends Controller
{
    private $pesan = [
        'required'       => ':attribute wajib diisi.',
        'exists'         => ':attribute yang dipilih tidak terdaftar.',
        'integer'        => ':attribute harus berupa angka bulat.',
        'between'        => ':attribute harus antara :min sampai :max.',
        'max'            => ':attribute maksimal :max karakter.',
        'in'             => ':attribute yang dipilih tidak valid.',
        'date'           => ':attribute harus berupa tanggal.',
        'after_or_equal' => ':attribute tidak boleh sebelum tanggal mulai.',
    ];

    private $atribut = [
        'menu_id'         => 'Menu',
        'judul_promo'     => 'Judul promo',
        'diskon_persen'   => 'Diskon',
        'tanggal_mulai'   => 'Tanggal mulai',
        'tanggal_selesai' => 'Tanggal selesai',
        'status'          => 'Status',
        'deskripsi'       => 'Deskripsi',
    ];

    private $aturan = [
        'menu_id'         => 'required|exists:menu,menu_id',
        'judul_promo'     => 'required|max:100',
        'diskon_persen'   => 'required|integer|between:1,90',
        'tanggal_mulai'   => 'required|date',
        'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        'status'          => 'required|in:Aktif,Nonaktif',
        'deskripsi'       => 'nullable|max:500',
    ];

    /**
     * List promo: leftJoin ke tabel menu + pencarian (nested where) + filter status.
     */
    public function index(Request $request)
    {
        $query = DB::table('promo')
            ->leftJoin('menu', 'promo.menu_id', '=', 'menu.menu_id')
            ->select(
                'promo.*',
                'menu.nama_menu',
                'menu.harga',
                DB::raw('menu.harga - (menu.harga * promo.diskon_persen / 100) as harga_promo')
            );

        // nested where: (judul_promo LIKE ... OR nama_menu LIKE ...)
        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('promo.judul_promo', 'like', "%{$cari}%")
                  ->orWhere('menu.nama_menu', 'like', "%{$cari}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('promo.status', $request->status);
        }

        $data['dataPromo'] = $query->orderByDesc('promo.tanggal_mulai')
            ->paginate(10)
            ->withQueryString();

        return view('admin.promo.index', $data);
    }

    /**
     * Form tambah promo (dropdown menu diambil dengan Query Builder).
     */
    public function create()
    {
        $data['dataMenu'] = DB::table('menu')
            ->select('menu_id', 'nama_menu', 'harga')
            ->orderBy('nama_menu')
            ->get();

        return view('admin.promo.create', $data);
    }

    /**
     * Simpan promo -> DB::table()->insert(). created_at/updated_at harus diisi manual.
     */
    public function store(Request $request)
    {
        $request->validate($this->aturan, $this->pesan, $this->atribut);

        try {
            DB::table('promo')->insert([
                'menu_id'         => $request->menu_id,
                'judul_promo'     => $request->judul_promo,
                'diskon_persen'   => $request->diskon_persen,
                'tanggal_mulai'   => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'status'          => $request->status,
                'deskripsi'       => $request->deskripsi,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan promo.');
        }

        return redirect()->route('promo.index')->with('success', 'Penambahan Data Promo Berhasil!');
    }

    public function show(string $id)
    {
        return redirect()->route('promo.index');
    }

    /**
     * Form edit promo -> DB::table()->where()->first().
     */
    public function edit(string $id)
    {
        $data['dataPromo'] = DB::table('promo')->where('promo_id', $id)->first();
        abort_if(! $data['dataPromo'], 404); // pengganti findOrFail()

        $data['dataMenu'] = DB::table('menu')
            ->select('menu_id', 'nama_menu', 'harga')
            ->orderBy('nama_menu')
            ->get();

        return view('admin.promo.edit', $data);
    }

    /**
     * Simpan perubahan -> DB::table()->where()->update().
     */
    public function update(Request $request, string $id)
    {
        $request->validate($this->aturan, $this->pesan, $this->atribut);

        abort_if(! DB::table('promo')->where('promo_id', $id)->exists(), 404);

        try {
            DB::table('promo')->where('promo_id', $id)->update([
                'menu_id'         => $request->menu_id,
                'judul_promo'     => $request->judul_promo,
                'diskon_persen'   => $request->diskon_persen,
                'tanggal_mulai'   => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'status'          => $request->status,
                'deskripsi'       => $request->deskripsi,
                'updated_at'      => now(),
            ]);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan perubahan promo.');
        }

        return redirect()->route('promo.index')->with('success', 'Perubahan Data Promo Berhasil!');
    }

    /**
     * Hapus promo -> DB::table()->where()->delete().
     */
    public function destroy(string $id)
    {
        try {
            $hapus = DB::table('promo')->where('promo_id', $id)->delete();
        } catch (\Exception $e) {
            return redirect()->route('promo.index')->with('error', 'Data Promo gagal dihapus.');
        }

        if (! $hapus) {
            return redirect()->route('promo.index')->with('error', 'Data Promo tidak ditemukan.');
        }

        return redirect()->route('promo.index')->with('success', 'Data Promo Berhasil Dihapus!');
    }
}
