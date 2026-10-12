<?php

namespace App\Http\Controllers;

use App\Models\Menu;

class HomeController extends Controller
{
    /**
     * Halaman awal Guest (landing page Geprekku).
     */
    public function index()
    {
        $data['dataMenu']     = Menu::where('status', 'Tersedia')->get();
        $data['jumlahMenu']   = $data['dataMenu']->count();
        $data['kategoriMenu'] = $data['dataMenu']->countBy('kategori');

        return view('guest.home', $data);
    }
}
