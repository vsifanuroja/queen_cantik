<?php

namespace App\Livewire;

use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Livewire\Component;
use App\Models\Produk as ModelProduk;

class Produk extends Component
{
    use WithFileUploads;

    public $fileExcel;
    public $pilihanMenu = 'lihat'; // ✅ Perbaiki Undefined Variable
    public $semuaProduk = [];
    public $kode, $nama, $harga, $stok, $produkTerpilih;

    public function render()
    {
        $this->semuaProduk = ModelProduk::all(); // ✅ Pastikan data diperbarui
        return view('livewire.produk', [
            'semuaProduk' => $this->semuaProduk
        ]);
    }

    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }

    public function simpanProduk()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => 'required|unique:produks,kode',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        ModelProduk::create([
            'nama' => $this->nama,
            'kode' => $this->kode,
            'harga' => $this->harga,
            'stok' => $this->stok
        ]);

        // Reset form
        $this->reset(['nama', 'kode', 'harga', 'stok']);

        // Update daftar produk
        $this->semuaProduk = ModelProduk::all();

        // Kembali ke tampilan daftar produk
        $this->pilihanMenu = 'lihat';
    }


    public function pilihEdit($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->kode = $this->produkTerpilih->kode;
        $this->nama = $this->produkTerpilih->nama;
        $this->harga = $this->produkTerpilih->harga;
        $this->stok = $this->produkTerpilih->stok;
        $this->pilihanMenu = 'edit';
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
        $this->semuaProduk = ModelProduk::all();
    }

    public function pilihHapus($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function hapus()
    {
        $this->produkTerpilih->delete();
        $this->reset(['produkTerpilih']);
        $this->pilihanMenu = 'lihat';
        $this->semuaProduk = ModelProduk::all();
    }

    public function importExcel()

    {
        $this->validate([
            'fileExcel' => 'required|mimes:xlsx,xls,csv'
        ]);

        $path = $this->fileExcel->getRealPath();
        $reader = new Xlsx();
        $spreadsheet = $reader->load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        foreach ($rows as $index => $row) {
            if ($index == 0 || empty($row[0])) continue; // Lewati header dan baris kosong

            ModelProduk::updateOrCreate(
                ['kode' => trim($row[0])],
                [
                    'nama'  => trim($row[1] ?? ''),
                    'harga' => is_numeric($row[2]) ? $row[2] : 0,
                    'stok'  => is_numeric($row[3]) ? $row[3] : 0
                ]
            );
        }

        session()->flash('message', 'Produk berhasil diimpor!');
        $this->semuaProduk = ModelProduk::all();
    }

    public function batal()
    {
        $this->pilihanMenu = 'lihat';
        $this->reset(['kode', 'nama', 'harga', 'stok', 'fileExcel']);
    }
}
