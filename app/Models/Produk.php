<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Add 'kode' to the fillable property
    protected $fillable = [
        'nama',
        'kode', // Add kode here
        'harga',
        'stok',
    ];
}
