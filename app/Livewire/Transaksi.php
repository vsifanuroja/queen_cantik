<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi as ModelsTransaksi;
use App\Models\detil_transaksi;
use App\Models\Produk; // ✅ Tambahkan ini

class Transaksi extends Component
{
    public function render()
{
    // Pastikan transaksi aktif ada
    $semuaProduk = [];
    if ($this->transaksiAktif) {
        $semuaProduk = detil_transaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
        $this->totalSebelumBelanja = $semuaProduk->sum(function ($detil) {
            return $detil->jumlah * $detil->produk->harga;
        });
    }

    return view('livewire.transaksi', [
        'semuaProduk' => $semuaProduk,
        'totalSemuaBelanja' => $this->totalSebelumBelanja ?? 0
    ]);
}


    public $kode, $total, $bayar = 0, $kembalian, $totalSebelumBelanja;
    public $transaksiAktif = null; // Ubah dari private ke public

    public function transaksiBaru(): void
    {
        $this->reset(['kode', 'total', 'bayar', 'kembalian', 'totalSebelumBelanja']);
        $this->transaksiAktif = ModelsTransaksi::create([
            'kode' => 'INV' . date('YmdHis'),
            'total' => 0,
            'status' => 'pending'
        ]);
    }

    public function batalTransaksi(): void
    {
        if ($this->transaksiAktif) {
            $detilTransaksi = detil_transaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            foreach ($detilTransaksi as $detil) {
                $produk =Produk::find($detil->produk_id);
                $produk->stok += $detil->jumlah;
                $produk->save();
                $detil->delete();
            }
            $this->transaksiAktif->delete();
        }

        $this->reset();
    }

    public function updatedKode(): void
    {
        $produk = Produk::where( 'kode',  $this->kode)->first();
        if ($produk && $produk->stok > 0) {
            $detil = detil_transaksi::firstOrNew(
                [
                    'transaksi_id' => $this->transaksiAktif->id,
                    'produk_id' => $produk->id
                ],
                ['jumlah' => 0] // Nilai default jika tidak ditemukan
            );

            $detil->jumlah += 1;
            $detil->save();
            $produk->stok -= 1;
            $produk->save();
            $this->reset('kode');


        }
    }

    public function hapusProduk($id)
    {
        $detil = detil_transaksi::find($id);
        if($detil){
            $produk = Produk::find($detil->produk_id);
            $produk->stok += ($detil->jumlah);
            $produk->save();
        }
        $detil->delete();
    }

    public function transaksiSelesai(){
        $this->transaksiAktif->total = $this->totalSebelumBelanja;
        $this->transaksiAktif->status = 'selesai';
        $this->transaksiAktif->save();
        $this->reset();
    }

    public function updatedBayar()
{
    $this->bayar = (float) $this->bayar;
    $this->totalSebelumBelanja = (float) $this->totalSebelumBelanja;

    $this->kembalian = $this->bayar - $this->totalSebelumBelanja;
}



}
