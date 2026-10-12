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
        'status',
    ];
}
