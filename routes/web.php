<?php

use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PelangganController;
use Illuminate\Support\Facades\Route;

// ===== Guest =====
Route::get('/', [HomeController::class, 'index'])->name('home');

// ===== Admin =====
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// CRUD 3 tabel master
Route::resource('menu', MenuController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('bahan-baku', BahanBakuController::class);
