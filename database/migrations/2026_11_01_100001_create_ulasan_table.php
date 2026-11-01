<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel ulasan (CRUD dengan Eloquent ORM).
     * Relasi: ulasan milik 1 pelanggan & 1 menu (many-to-one).
     */
    public function up(): void
    {
        Schema::create('ulasan', function (Blueprint $table) {
            $table->increments('ulasan_id');
            $table->unsignedInteger('pelanggan_id');
            $table->unsignedInteger('menu_id');
            $table->tinyInteger('rating');            // 1 - 5 bintang
            $table->text('komentar');
            $table->date('tanggal_ulasan');
            $table->boolean('tampil')->default(true); // tampil di halaman Guest atau tidak
            $table->timestamps();

            // foreign key: jika pelanggan / menu dihapus, ulasannya ikut terhapus
            $table->foreign('pelanggan_id')->references('pelanggan_id')->on('pelanggan')->cascadeOnDelete();
            $table->foreign('menu_id')->references('menu_id')->on('menu')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
