<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Transaksi as ModelsTransaksi;
use App\Models\DetilTransaksi;
use App\Models\Produk;

class Transaksi extends Component
{
    public function render()
    {
        $semuaProduk = [];
        $this->totalSebelumBelanja = 0;

        if ($this->transaksiAktif) {
            $semuaProduk = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)->get();
            $this->totalSebelumBelanja = $semuaProduk->sum(fn($detil) => $detil->jumlah * $detil->produk->harga);
        }

        return view('livewire.transaksi', [
            'semuaProduk' => $semuaProduk,
            'totalSemuaBelanja' => $this->totalSebelumBelanja
        ]);
    }

    public $kode, $total, $bayar = 0, $kembalian, $totalSebelumBelanja;
    public $transaksiAktif = null;

    public function transaksiBaru(): void
    {
        $this->reset(['kode', 'total', 'bayar', 'kembalian', 'totalSebelumBelanja']);
        $this->transaksiAktif = ModelsTransaksi::create([
            'kode' => 'INV' . date('YmdHis'),
            'total' => 0,
            'status' => 'pending',
            'kasir_id' => Auth::id() // Menyimpan ID kasir yang sedang login
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

        if ($produk->stok > 0) {
            $detil = DetilTransaksi::firstOrNew(
                ['transaksi_id' => $this->transaksiAktif->id, 'produk_id' => $produk->id],
                ['jumlah' => 0]
            );

            $detil->jumlah += 1;
            $detil->save();
            $produk->stok -= 1;
            $produk->save();
        } else {
            session()->flash('error', 'Stok tidak mencukupi!');
        }

        $this->reset('kode');
    }


    public function hapusProduk($id)
    {
        $detil = DetilTransaksi::find($id);
        if ($detil) {
            $produk = Produk::find($detil->produk_id);
            $produk->stok += $detil->jumlah;
            $produk->save();
        }
        $detil->delete();
    }
    public function transaksiSelesai()
    {
        // Pastikan ada transaksi aktif sebelum lanjut
        if (!$this->transaksiAktif) {
            session()->flash('error', 'Tidak ada transaksi yang sedang berlangsung!');
            return;
        }

        // Hitung ulang total jika perlu
        $this->totalSebelumBelanja = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)
            ->get()
            ->sum(fn($detil) => $detil->jumlah * $detil->produk->harga);

        // Cek apakah pembayaran mencukupi
        if ($this->bayar < $this->totalSebelumBelanja) {
            session()->flash('error', 'Pembayaran tidak cukup!');
            return;
        }

        // Update transaksi menjadi selesai
        $this->transaksiAktif->update([
            'total' => $this->totalSebelumBelanja,
            'status' => 'selesai'
        ]);

        // Reset semua variabel setelah transaksi selesai
        $this->reset(['transaksiAktif', 'kode', 'total', 'bayar', 'kembalian', 'totalSebelumBelanja']);

        session()->flash('success', 'Transaksi berhasil diselesaikan!');
    }


    public function updatedBayar()
{
    $this->bayar = (float) $this->bayar;

    // Hitung ulang total setiap kali pembayaran diubah
    $this->totalSebelumBelanja = DetilTransaksi::where('transaksi_id', $this->transaksiAktif->id)
        ->get()
        ->sum(fn($detil) => $detil->jumlah * $detil->produk->harga);

    $this->kembalian = max($this->bayar - $this->totalSebelumBelanja, 0); // Tidak boleh negatif
}




    public function tambahJumlah($id)
{
    $detil = DetilTransaksi::find($id);

    if ($detil) {
        // Pastikan stok masih tersedia sebelum menambah jumlah
        if ($detil->produk->stok > 0) {
            $detil->jumlah += 1;
            $detil->save();

            // Kurangi stok produk
            $produk = Produk::find($detil->produk_id);
            $produk->stok -= 1;
            $produk->save();
        } else {
            session()->flash('error', 'Stok tidak mencukupi!');
        }
    }
}



public function kurangiJumlah($id)
{
    $detil = DetilTransaksi::find($id);

    if ($detil && $detil->jumlah > 1) {
        $detil->jumlah -= 1;
        $detil->save();

        // Kembalikan stok produk
        $produk = Produk::find($detil->produk_id);
        $produk->stok += 1;
        $produk->save();
    } elseif ($detil) {
        session()->flash('error', 'Jumlah minimal 1');
    }
}

}
