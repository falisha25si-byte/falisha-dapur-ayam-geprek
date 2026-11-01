<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Ulasan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Data contoh ulasan (Eloquent) & promo (Query Builder).
 * Memakai data menu & pelanggan yang SUDAH ADA di database.
 * Jalankan: php artisan db:seed --class=UlasanPromoSeeder
 */
class UlasanPromoSeeder extends Seeder
{
    public function run(): void
    {
        $menu      = Menu::orderBy('menu_id')->get();
        $pelanggan = Pelanggan::orderBy('pelanggan_id')->get();

        if ($menu->isEmpty() || $pelanggan->isEmpty()) {
            $this->command->warn('Isi dulu data menu & pelanggan (GeprekkuSeeder), lalu jalankan seeder ini lagi.');
            return;
        }

        // ---------- ULASAN (Eloquent) ----------
        $komentar = [
            [5, 'Sambalnya pedas nampol, ayamnya crispy banget. Wajib coba!'],
            [4, 'Porsinya pas buat mahasiswa, harganya juga ramah di kantong.'],
            [5, 'Kejunya lumer, level 3 sudah cukup bikin keringetan.'],
            [3, 'Enak, tapi pas jam makan siang antreannya lumayan lama.'],
            [5, 'Sambal matahnya segar, beda dari geprek biasa.'],
            [4, 'Es tehnya pas buat penawar pedas. Bakal balik lagi.'],
        ];

        foreach ($komentar as $i => [$rating, $isi]) {
            Ulasan::create([
                'pelanggan_id'   => $pelanggan[$i % $pelanggan->count()]->pelanggan_id,
                'menu_id'        => $menu[$i % $menu->count()]->menu_id,
                'rating'         => $rating,
                'komentar'       => $isi,
                'tanggal_ulasan' => now()->subDays($i * 2)->toDateString(),
                'tampil'         => true,
            ]);
        }

        // ---------- PROMO (Query Builder) ----------
        $promo = [
            ['Promo Gajian', 25, now()->subDays(2), now()->addDays(5), 'Aktif', 'Diskon spesial akhir bulan untuk makan di tempat maupun bawa pulang.'],
            ['Jumat Berkah', 15, now()->subDays(10), null, 'Aktif', 'Setiap hari, tanpa batas waktu.'],
            ['Paket Begadang', 20, now()->subDays(1), now()->addDays(14), 'Aktif', 'Teman setia ngerjain tugas sampai malam.'],
            ['Promo Lebaran', 30, now()->subDays(60), now()->subDays(30), 'Aktif', 'Promo yang sudah berakhir (tidak tampil di Guest).'],
            ['Promo Uji Coba', 10, now(), null, 'Nonaktif', 'Promo nonaktif (tidak tampil di Guest).'],
        ];

        foreach ($promo as $i => [$judul, $diskon, $mulai, $selesai, $status, $deskripsi]) {
            DB::table('promo')->insert([
                'menu_id'         => $menu[$i % $menu->count()]->menu_id,
                'judul_promo'     => $judul,
                'diskon_persen'   => $diskon,
                'tanggal_mulai'   => $mulai->toDateString(),
                'tanggal_selesai' => $selesai?->toDateString(),
                'status'          => $status,
                'deskripsi'       => $deskripsi,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}
