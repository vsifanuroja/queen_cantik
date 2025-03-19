<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Livewire\Beranda;
use App\Livewire\User;
use App\Livewire\Laporan;
use App\Livewire\Produk;
use App\Livewire\Transaksi;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get(uri: '/home', action: Beranda::class)->middleware(middleware: ['auth'])->name(name: 'home');
Route::get(uri: '/user', action: User::class)->middleware(middleware: ['auth'])->name(name: 'user');

Route::get(uri: '/laporan', action: Laporan::class)->middleware(middleware: ['auth'])->name(name: 'laporan');
Route::get(uri: '/produk', action: Produk::class)->middleware(middleware: ['auth'])->name(name: 'produk');

Route::get(uri: '/transaksi', action: Transaksi::class)->middleware(middleware: ['auth'])->name(name: 'transaksi');
