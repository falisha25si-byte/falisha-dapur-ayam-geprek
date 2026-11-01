<?php

use App\Models\Menu;
use App\Models\Ulasan;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
 * Hapus menu dobel (nama sama, huruf besar/kecil diabaikan).
 * Yang dipertahankan: menu yang punya foto; kalau sama-sama tidak ada, menu yang dibuat paling awal.
 * Ulasan & promo milik menu dobel dipindahkan ke menu yang dipertahankan (tidak ikut terhapus).
 * Jalankan: php artisan menu:hapus-duplikat
 */
Artisan::command('menu:hapus-duplikat', function () {
    $grup = Menu::orderBy('menu_id')->get()
        ->groupBy(fn ($m) => Str::lower(trim($m->nama_menu)))
        ->filter(fn ($daftar) => $daftar->count() > 1);

    if ($grup->isEmpty()) {
        $this->info('Tidak ada menu dobel.');
        return;
    }

    foreach ($grup as $daftar) {
        $simpan = $daftar->sortByDesc(fn ($m) => (bool) $m->gambar)->first();
        $hapus  = $daftar->where('menu_id', '!=', $simpan->menu_id);
        $idHapus = $hapus->pluck('menu_id');

        Ulasan::whereIn('menu_id', $idHapus)->update(['menu_id' => $simpan->menu_id]);
        DB::table('promo')->whereIn('menu_id', $idHapus)->update(['menu_id' => $simpan->menu_id]);

        foreach ($hapus as $menu) {
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $menu->delete();
            $this->line("Dihapus: [{$menu->menu_id}] {$menu->nama_menu}");
        }
        $this->info("Dipertahankan: [{$simpan->menu_id}] {$simpan->nama_menu}");
    }
})->purpose('Hapus data menu dengan nama yang sama');
