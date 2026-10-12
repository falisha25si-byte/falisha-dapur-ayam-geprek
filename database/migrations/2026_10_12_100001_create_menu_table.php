<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('menu_id');
            $table->string('nama_menu', 100);
            $table->enum('kategori', ['Ayam Geprek', 'Paket Hemat', 'Minuman', 'Tambahan']);
            $table->integer('harga');
            $table->tinyInteger('level_pedas')->default(0);
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['Tersedia', 'Habis'])->default('Tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
