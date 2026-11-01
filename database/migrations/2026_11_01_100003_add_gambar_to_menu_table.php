<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambah kolom gambar (path foto menu) ke tabel menu yang sudah ada.
     */
    public function up(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('deskripsi');
        });
    }

    public function down(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};
