<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detil_transaksi extends Model
{
    public function produk()
{
    return $this->belongsTo(Produk::class);
}

}
