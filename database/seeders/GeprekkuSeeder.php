<?php

namespace Database\Seeders;

use App\Models\BahanBaku;
use App\Models\Menu;
use App\Models\Pelanggan;
use Illuminate\Database\Seeder;

class GeprekkuSeeder extends Seeder
{
    /**
     * Data contoh untuk 3 tabel master Geprekku.
     */
    public function run(): void
    {
        $menu = [
            ['nama_menu' => 'Ayam Geprek Original', 'kategori' => 'Ayam Geprek', 'harga' => 15000, 'level_pedas' => 2, 'deskripsi' => 'Ayam crispy digeprek dengan sambal bawang ulek dadakan.', 'status' => 'Tersedia'],
            ['nama_menu' => 'Ayam Geprek Mozarella', 'kategori' => 'Ayam Geprek', 'harga' => 22000, 'level_pedas' => 3, 'deskripsi' => 'Geprek pedas dengan lelehan keju mozarella di atasnya.', 'status' => 'Tersedia'],
            ['nama_menu' => 'Geprek Sambal Matah', 'kategori' => 'Ayam Geprek', 'harga' => 18000, 'level_pedas' => 4, 'deskripsi' => 'Ayam geprek dengan sambal matah khas Bali yang segar.', 'status' => 'Tersedia'],
            ['nama_menu' => 'Paket Kenyang Mahasiswa', 'kategori' => 'Paket Hemat', 'harga' => 20000, 'level_pedas' => 5, 'deskripsi' => 'Nasi, ayam geprek, tahu, tempe, lalapan, dan es teh.', 'status' => 'Tersedia'],
            ['nama_menu' => 'Es Teh Manis', 'kategori' => 'Minuman', 'harga' => 5000, 'level_pedas' => 0, 'deskripsi' => 'Teh manis dingin penawar pedas.', 'status' => 'Tersedia'],
            ['nama_menu' => 'Tahu Tempe Goreng', 'kategori' => 'Tambahan', 'harga' => 5000, 'level_pedas' => 0, 'deskripsi' => 'Lauk tambahan tahu dan tempe goreng.', 'status' => 'Habis'],
        ];
        foreach ($menu as $item) {
            Menu::create($item);
        }

        $pelanggan = [
            ['nama_pelanggan' => 'Rizky Pratama', 'jenis_kelamin' => 'Laki-laki', 'no_hp' => '081234567801', 'email' => 'rizky@mail.com', 'tanggal_lahir' => '2004-03-12', 'alamat' => 'Jl. Umban Sari, Rumbai'],
            ['nama_pelanggan' => 'Siti Aisyah', 'jenis_kelamin' => 'Perempuan', 'no_hp' => '081234567802', 'email' => 'siti@mail.com', 'tanggal_lahir' => '2005-07-21', 'alamat' => 'Jl. Yos Sudarso, Pekanbaru'],
            ['nama_pelanggan' => 'Dimas Saputra', 'jenis_kelamin' => 'Laki-laki', 'no_hp' => '081234567803', 'email' => 'dimas@mail.com', 'tanggal_lahir' => null, 'alamat' => 'Jl. Sudirman No. 10'],
        ];
        foreach ($pelanggan as $item) {
            Pelanggan::create($item);
        }

        $bahan = [
            ['nama_bahan' => 'Daging Ayam', 'satuan' => 'kg', 'stok' => 25, 'harga_satuan' => 35000, 'supplier' => 'Toko Ayam Segar', 'tanggal_masuk' => '2026-10-10'],
            ['nama_bahan' => 'Cabai Rawit', 'satuan' => 'kg', 'stok' => 4, 'harga_satuan' => 60000, 'supplier' => 'Pasar Cik Puan', 'tanggal_masuk' => '2026-10-11'],
            ['nama_bahan' => 'Tepung Bumbu', 'satuan' => 'kg', 'stok' => 12, 'harga_satuan' => 18000, 'supplier' => 'Toko Sembako Jaya', 'tanggal_masuk' => '2026-10-09'],
            ['nama_bahan' => 'Minyak Goreng', 'satuan' => 'liter', 'stok' => 3, 'harga_satuan' => 17000, 'supplier' => 'Toko Sembako Jaya', 'tanggal_masuk' => '2026-10-08'],
        ];
        foreach ($bahan as $item) {
            BahanBaku::create($item);
        }
    }
}
