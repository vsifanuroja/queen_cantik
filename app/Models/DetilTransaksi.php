<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetilTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detil_transaksis';
    // ⬅️ Perbaiki nama tabel agar sesuai dengan database

    protected $fillable = ['transaksi_id', 'produk_id', 'jumlah'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id'); // ⬅️ Hapus "ModelsTransaksi", cukup "Transaksi::class"
    }
}
