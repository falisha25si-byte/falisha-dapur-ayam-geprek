<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table      = 'menu';
    protected $primaryKey = 'menu_id';
    protected $fillable   = [
        'nama_menu',
        'kategori',
        'harga',
        'level_pedas',
        'deskripsi',
        'gambar',
        'status',
    ];

    /**
     * Accessor: $menu->gambar_url
     * URL foto menu; jika belum ada foto, pakai gambar default Geprekku.
     */
    public function getGambarUrlAttribute()
    {
        return $this->gambar
            ? asset('storage/' . $this->gambar)
            : asset('assets-guest/img/menu-default.jpg');
    }

    /**
     * Relasi: satu menu punya banyak ulasan (hasMany).
     */
    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'menu_id', 'menu_id');
    }
}
