<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table      = 'ulasan';
    protected $primaryKey = 'ulasan_id';
    protected $fillable   = [
        'pelanggan_id',
        'menu_id',
        'rating',
        'komentar',
        'tanggal_ulasan',
        'tampil',
    ];

    protected $casts = [
        'tanggal_ulasan' => 'date',
        'tampil'         => 'boolean',
    ];

    /**
     * Relasi: ulasan milik satu pelanggan (belongsTo).
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
    }

    /**
     * Relasi: ulasan milik satu menu (belongsTo).
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'menu_id');
    }
}
