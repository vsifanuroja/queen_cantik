<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;
use Carbon\Carbon;

class Laporan extends Component
{
    public $bulan;
    public $tanggal_mulai;
    public $tanggal_selesai;

    public function render()
    {
        $query = Transaksi::where('status', 'selesai');

        if ($this->tanggal_mulai && $this->tanggal_selesai) {
            $start = Carbon::parse($this->tanggal_mulai)->startOfDay();
            $end = Carbon::parse($this->tanggal_selesai)->endOfDay();

            $query = $query->whereBetween('created_at', [$start, $end]);

            // Terapkan filter rentang tanggal
            $query->whereBetween('created_at', [$start, $end]);
        } elseif ($this->bulan) {
            // Filter berdasarkan bulan jika rentang tanggal tidak dipilih
            $query->whereMonth('created_at', Carbon::parse($this->bulan)->month)
                  ->whereYear('created_at', Carbon::parse($this->bulan)->year);
        }

        $semuaTransaksi = $query->orderBy('created_at', 'asc')->get();

        return view('livewire.laporan', ['semuaTransaksi' => $semuaTransaksi]);
    }

    public function updated($propertyName)
{
    if (in_array($propertyName, ['tanggal_mulai', 'tanggal_selesai', 'bulan'])) {
        $this->render(); // Memperbarui tampilan saat input berubah
    }
}

}
