<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk as ModelProduk;

class Produk extends Component
{
    public $kode, $nama, $harga, $stok;
    public $semuaProduk = [];
    public $pilihanMenu = 'lihat';
    public $produkTerpilih;

    public function mount()
    {
        $this->semuaProduk = ModelProduk::all();
    }

    public function render()
    {
        return view('livewire.produk')->with(['semuaproduk' => ModelProduk::all()]);
    }

    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }

    public function simpan()
{
    $this->validate([
        'kode' => 'required',
        'nama' => 'required',
        'harga' => 'required|numeric',
        'stok' => 'required|numeric'
    ]);

    ModelProduk::create([
        'kode' => $this->kode,
        'nama' => $this->nama,
        'harga' => $this->harga,
        'stok' => $this->stok
    ]);

    $this->reset(['kode', 'nama', 'harga', 'stok']);
    $this->pilihanMenu = 'lihat';

    // 🔄 Langsung update produk tanpa refresh
    $this->semuaProduk = ModelProduk::all();
}


    public function batal()
    {
        $this->pilihanMenu = 'lihat';
        $this->reset(['kode', 'nama', 'harga', 'stok']);
    }

    public function pilihEdit($id)
    {
        $this->produkTerpilih = ModelProduk::find($id);
        $this->kode = $this->produkTerpilih->kode;
        $this->nama = $this->produkTerpilih->nama;
        $this->harga = $this->produkTerpilih->harga;
        $this->stok = $this->produkTerpilih->stok;
        $this->pilihanMenu = 'edit';
    }

    public function pilihHapus($id)
    {
        $this->produkTerpilih = ModelProduk::find($id);
        $this->pilihanMenu = 'hapus';
    }

    public function simpanEdit()
    {
        $this->validate([
            'kode' => 'required',
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        $this->produkTerpilih->update([
            'kode' => $this->kode,
            'nama' => $this->nama,
            'harga' => $this->harga,
            'stok' => $this->stok
        ]);

        $this->reset(['kode', 'nama', 'harga', 'stok', 'produkTerpilih']);
        $this->pilihanMenu = 'lihat';

        // 🔄 Update data langsung
        $this->semuaProduk = ModelProduk::all();
    }

    public function hapus()
    {
        $this->produkTerpilih->delete();
        $this->reset(['produkTerpilih']);
        $this->pilihanMenu = 'lihat';

        // 🔄 Update data langsung
        $this->semuaProduk = ModelProduk::all();
    }

     // public function mount(){
    //     if (auth()->user()->role != 'admin'){
    //         abort(403);
    //     }
    // }
}
