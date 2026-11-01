<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Ulasan;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Halaman awal Guest (landing page Geprekku).
     */
    public function index()
    {
        // ELOQUENT: menu + rata-rata rating & jumlah ulasan dari relasi hasMany
        $data['dataMenu'] = Menu::where('status', 'Tersedia')
            ->withAvg(['ulasan' => fn ($q) => $q->where('tampil', true)], 'rating')
            ->withCount(['ulasan' => fn ($q) => $q->where('tampil', true)])
            ->get();
        $data['jumlahMenu']   = $data['dataMenu']->count();
        $data['kategoriMenu'] = $data['dataMenu']->countBy('kategori');

        // Foto untuk hero, kategori, galeri & blog: menu yang sudah punya foto didahulukan
        $data['fotoMenu'] = $data['dataMenu']
            ->sortByDesc(fn ($m) => [(bool) $m->gambar, $m->ulasan_avg_rating])
            ->values();
        $data['menuUnggulan'] = $data['fotoMenu']->first();

        // ELOQUENT: ulasan terbaru yang boleh tampil + data relasinya (eager loading)
        $data['dataUlasan'] = Ulasan::with(['pelanggan', 'menu'])
            ->where('tampil', true)
            ->orderByDesc('tanggal_ulasan')
            ->take(8)
            ->get();

        // QUERY BUILDER: promo aktif (join ke menu + nested where untuk periode)
        $hariIni = now()->toDateString();
        $data['dataPromo'] = DB::table('promo')
            ->join('menu', 'promo.menu_id', '=', 'menu.menu_id')
            ->select(
                'promo.*',
                'menu.nama_menu',
                'menu.kategori',
                'menu.harga',
                'menu.gambar',
                DB::raw('menu.harga - (menu.harga * promo.diskon_persen / 100) as harga_promo')
            )
            ->where('promo.status', 'Aktif')
            ->where('menu.status', 'Tersedia')
            ->where('promo.tanggal_mulai', '<=', $hariIni)
            ->where(function ($q) use ($hariIni) {
                // berlaku tanpa batas ATAU belum lewat tanggal selesai
                $q->whereNull('promo.tanggal_selesai')
                  ->orWhere('promo.tanggal_selesai', '>=', $hariIni);
            })
            ->orderByDesc('promo.diskon_persen')
            ->get();

        return view('guest.home', $data);
    }

    /**
     * Halaman Contact Us (GET /contact).
     */
    public function contact()
    {
        return view('guest.contact');
    }
}
