<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Transaksi as ModelsTransaksi;
use App\Models\DetilTransaksi;
use App\Models\Produk;

class Transaksi extends Component
{
    public $kode, $total, $bayar = 0, $kembalian, $totalSebelumBelanja;
    public $transaksiAktif = null;
    public $barcode;

    public function render()
    {
        $semuaProduk = [];
        $this->totalSebelumBelanja = 0;
        $kasir = null; // Pastikan variabel kasir dideklarasikan sebelum digunakan

        if ($this->transaksiAktif) {
            $kasir = $this->transaksiAktif->kasir;
            $semuaProduk = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            $this->totalSebelumBelanja = $semuaProduk->sum(fn($detil) => $detil->jumlah * $detil->produk->harga);
        }

        return view('livewire.transaksi', [
            'semuaProduk' => $semuaProduk,
            'totalSemuaBelanja' => $this->totalSebelumBelanja,
            'kasir' => $kasir,
        ]);
    }

    public function transaksiBaru(): void
    {
        $this->reset(['kode', 'total', 'bayar', 'kembalian', 'totalSebelumBelanja']);
        $this->transaksiAktif = ModelsTransaksi::create([
            'kode' => 'INV' . date('YmdHis'),
            'total' => 0,
            'status' => 'pending',
            'kasir_id' => Auth::id()
        ]);
    }

    public function batalTransaksi(): void
    {
        if ($this->transaksiAktif) {
            $detilTransaksi = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            foreach ($detilTransaksi as $detil) {
                $produk = Produk::find($detil->produk_id);
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
        $produk = Produk::where('kode', $this->kode)->first();

        if (!$produk) {
            session()->flash('error', 'Produk tidak ditemukan!');
            $this->reset('kode');
            return;
        }

        $this->tambahProduk($produk->id);
        $this->reset('kode');
    }

    public function tambahProduk($id)
    {
        $produk = Produk::find($id);

        if (!$produk || $produk->stok <= 0) {
            session()->flash('error', 'Stok tidak mencukupi atau produk tidak ditemukan!');
            return;
        }

        $detil = DetilTransaksi::firstOrNew(
            ['transaksi_id' => $this->transaksiAktif->id, 'produk_id' => $produk->id],
            ['jumlah' => 0]
        );

        $detil->jumlah += 1;
        $detil->save();

        $produk->stok -= 1;
        $produk->save();
    }

    public function hapusProduk($id)
    {
        $detil = DetilTransaksi::find($id);
        if ($detil) {
            $produk = Produk::find($detil->produk_id);
            $produk->stok += $detil->jumlah;
            $produk->save();
            $detil->delete();
        }
    }

    public function transaksiSelesai()
    {
        if (!$this->transaksiAktif) {
            session()->flash('error', 'Tidak ada transaksi yang sedang berlangsung!');
            return;
        }

        $this->totalSebelumBelanja = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)
            ->get()
            ->sum(fn($detil) => $detil->jumlah * $detil->produk->harga);

        if ($this->bayar < $this->totalSebelumBelanja) {
            session()->flash('error', 'Pembayaran tidak cukup!');
            return;
        }

        $this->transaksiAktif->update([
            'total' => $this->totalSebelumBelanja,
            'status' => 'selesai'
        ]);

        session()->flash('success', 'Transaksi berhasil diselesaikan!');
        return redirect()->route('nota.cetak', ['id' => $this->transaksiAktif->id]);
    }

    public function updatedBayar()
    {
        $this->bayar = (float) $this->bayar;

        $this->totalSebelumBelanja = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)
            ->get()
            ->sum(fn($detil) => $detil->jumlah * $detil->produk->harga);

        $this->kembalian = max($this->bayar - $this->totalSebelumBelanja, 0);
    }

    public function tambahJumlah($id)
    {
        $detil = DetilTransaksi::find($id);

        if ($detil && $detil->produk->stok > 0) {
            $detil->jumlah += 1;
            $detil->save();

            $produk = Produk::find($detil->produk_id);
            $produk->stok -= 1;
            $produk->save();
        } else {
            session()->flash('error', 'Stok tidak mencukupi!');
        }
    }

    public function kurangiJumlah($id)
    {
        $detil = DetilTransaksi::find($id);

        if ($detil && $detil->jumlah > 1) {
            $detil->jumlah -= 1;
            $detil->save();

            $produk = Produk::find($detil->produk_id);
            $produk->stok += 1;
            $produk->save();
        } else {
            session()->flash('error', 'Jumlah minimal 1');
        }
    }

    public function printNota()
    {
        if (!$this->transaksiAktif || $this->transaksiAktif->status !== 'selesai') {
            session()->flash('error', 'Nota hanya bisa dicetak setelah transaksi selesai!');
            return;
        }

        return redirect()->route('nota.cetak', ['id' => $this->transaksiAktif->id]);
    }

    public function tambahProdukDariBarcode()
    {
        $produk = Produk::where('barcode', $this->barcode)->first();

        if ($produk) {
            $this->tambahProduk($produk->id);
            $this->barcode = '';
        } else {
            session()->flash('error', 'Produk tidak ditemukan!');
        }
    }
}
