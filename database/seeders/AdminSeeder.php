<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Akun Admin pertama (role Admin tidak bisa daftar lewat halaman Register).
 * Jalankan: php artisan db:seed --class=AdminSeeder
 */
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // updateOrCreate: aman dijalankan ulang, tidak membuat admin dobel
        User::updateOrCreate(
            ['email' => 'admin@geprekku.id'],
            [
                'name'     => 'Admin Geprekku',
                'password' => Hash::make('admin12345'),
                'role'     => 'Admin',
            ]
        );
    }
}
