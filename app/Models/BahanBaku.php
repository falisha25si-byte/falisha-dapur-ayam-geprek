<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table      = 'bahan_baku';
    protected $primaryKey = 'bahan_baku_id';
    protected $fillable   = [
        'nama_bahan',
        'satuan',
        'stok',
        'harga_satuan',
        'supplier',
        'tanggal_masuk',
    ];
}
