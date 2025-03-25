<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;
use App\Models\Produk;

class DetilTransaksi extends Model
{
    use HasFactory;

    protected $fillable = ['transaksi_id', 'produk_id', 'jumlah'];




    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id'); // ⬅️ Hapus "ModelsTransaksi", cukup "Transaksi::class"
    }
}
