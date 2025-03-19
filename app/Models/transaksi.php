<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Add 'kode' to the fillable array
    protected $fillable = ['kode', 'total', 'status'];

    // Optionally, you can define the timestamps if needed
    public $timestamps = true;
}
