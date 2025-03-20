<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function cetak()
{
    $semuaTransaksi = Transaksi::where('status', 'selesai')->get();
    return view('cetak', compact('semuaTransaksi'));
}

}
