<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Transaksi;
use App\Models\DetilTransaksi;

class NotaController extends Controller
{
    public function cetakNota($id)
    {
        // Ambil data transaksi berdasarkan ID
        $transaksi = Transaksi::with('kasir')->findOrFail($id);
        $detilTransaksi = DetilTransaksi::where('transaksi_id', $id)->with('produk')->get();

        // Generate PDF
        $pdf = Pdf::loadView('nota', compact('transaksi', 'detilTransaksi'))->setPaper('A6', 'portrait');

        return $pdf->stream("Nota_{$transaksi->kode}.pdf"); // Menampilkan PDF di browser
    }
}
