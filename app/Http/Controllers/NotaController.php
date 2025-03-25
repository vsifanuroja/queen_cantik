<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NotaController extends Controller
{
    public function cetak($id)
    {
        $transaksi = Transaksi::with('detilTransaksi.produk')->findOrFail($id);

        if ($transaksi->status !== 'selesai') {
            return redirect()->back()->with('error', 'Nota hanya bisa dicetak untuk transaksi yang selesai!');
        }

        $pdf = Pdf::loadView('nota', compact('transaksi'));
        return $pdf->stream('nota-transaksi.pdf');
    }
}

