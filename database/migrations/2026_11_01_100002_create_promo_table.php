<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel promo (CRUD dengan Query Builder).
     * Relasi: promo milik 1 menu (many-to-one), diambil dengan join / leftJoin.
     */
    public function up(): void
    {
        Schema::create('promo', function (Blueprint $table) {
            $table->increments('promo_id');
            $table->unsignedInteger('menu_id');
            $table->string('judul_promo', 100);
            $table->tinyInteger('diskon_persen');     // 1 - 90 %
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable(); // kosong = berlaku tanpa batas
            $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('menu_id')->references('menu_id')->on('menu')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promo');
    }
};
