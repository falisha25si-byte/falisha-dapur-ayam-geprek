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
        Schema::create('bahan_baku', function (Blueprint $table) {
            $table->increments('bahan_baku_id');
            $table->string('nama_bahan', 100);
            $table->enum('satuan', ['kg', 'gram', 'liter', 'pcs', 'ikat']);
            $table->integer('stok');
            $table->integer('harga_satuan');
            $table->string('supplier', 100)->nullable();
            $table->date('tanggal_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_baku');
    }
};
