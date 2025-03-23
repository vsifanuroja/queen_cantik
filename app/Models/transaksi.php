<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'total', 'status', 'kasir_id'];


    public function detilTransaksi()
    {
        return $this->hasMany(DetilTransaksi::class);
    }
    public function produk()
{
    return $this->hasMany(DetilTransaksi::class, 'transaksi_id');
}

}
