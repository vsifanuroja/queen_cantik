<?php

namespace App\Models;
use Milon\Barcode\DNS1D;
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
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($produk) {
            if (empty($produk->barcode)) {
                $produk->barcode = rand(100000000000, 999999999999); // Generate barcode otomatis
            }
        });
    }

}
