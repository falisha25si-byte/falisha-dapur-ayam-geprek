<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Menu;
use App\Models\Pelanggan;

class DashboardController extends Controller
{
    /**
     * Halaman awal Admin.
     */
    public function index()
    {
        $data['jumlahMenu']      = Menu::count();
        $data['jumlahPelanggan'] = Pelanggan::count();
        $data['jumlahBahan']     = BahanBaku::count();
        $data['stokMenipis']     = BahanBaku::where('stok', '<=', 5)->orderBy('stok')->get();
        $data['menuTerbaru']     = Menu::latest()->take(5)->get();
        $data['pelangganBaru']   = Pelanggan::latest()->take(5)->get();

        return view('admin.dashboard', $data);
    }
}
