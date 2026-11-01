<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PesanKontakController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ===== Guest =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [PesanKontakController::class, 'store'])->name('contact.kirim'); // proses form Contact Us

// Login
Route::get('/auth', [AuthController::class, 'index'])->name('auth');            // tampilkan form
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login'); // proses form

// ===== Admin =====
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// CRUD 3 tabel master
Route::resource('menu', MenuController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('bahan-baku', BahanBakuController::class);

// CRUD User
Route::resource('user', UserController::class);

// CRUD berelasi: Ulasan (Eloquent ORM) & Promo (Query Builder)
Route::resource('ulasan', UlasanController::class);
Route::resource('promo', PromoController::class);


// Pesan masuk dari form Contact Us
Route::resource('pesan', PesanKontakController::class)->only(['index', 'show', 'destroy']);
