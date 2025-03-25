<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Livewire\Beranda;
use App\Livewire\User;
use App\Livewire\Laporan;
use App\Livewire\Produk;
use App\Livewire\Transaksi;
use App\Http\Controllers\NotaController;


// Route untuk halaman utama (Welcome Page) sebelum login
Route::get('/', function () {
    return view('welcome'); // Pastikan welcome.blade.php ada di resources/views
})->name('welcome');


Route::get('/about', function () {
    return view('about');
})->name('about');

// Route untuk halaman beranda setelah login
Route::get('/home', Beranda::class)->middleware('auth')->name('home');

// Route transaksi dengan middleware khusus
Route::get('/transaksi', Transaksi::class)
    ->middleware(['auth']) // Hanya auth, tanpa role
    ->name('transaksi');

// Otentikasi (nonaktifkan register)
Auth::routes(['register' => false]);

// Route lainnya (hanya bisa diakses setelah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/user', User::class)->name('user');
    Route::get('/laporan', Laporan::class)->name('laporan');
    Route::get('/produk', Produk::class)->name('produk');
});

// Route cetak laporan
Route::get('/cetak', [HomeController::class, 'cetak']);

Route::get('/nota/cetak/{id}', [NotaController::class, 'cetak'])->name('nota.cetak');
