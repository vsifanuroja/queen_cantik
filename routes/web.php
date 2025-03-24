<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Livewire\Beranda;
use App\Livewire\User;
use App\Livewire\Laporan;
use App\Livewire\Produk;
use App\Livewire\Transaksi;

// Route untuk halaman utama
Route::get('/', Beranda::class)->middleware('auth')->name('home');

// Route transaksi dengan middleware khusus
Route::get('/transaksi', Transaksi::class)
    ->middleware(['auth']) // Hanya auth, tanpa role
    ->name('transaksi');


// Otentikasi
Auth::routes(['register' => false]);

// Route lainnya
Route::get('/user', User::class)->middleware('auth')->name('user');
Route::get('/laporan', Laporan::class)->middleware('auth')->name('laporan');
Route::get('/produk', Produk::class)->middleware('auth')->name('produk');

// Route cetak laporan
Route::get('/cetak', [HomeController::class, 'cetak']);
