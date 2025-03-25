<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory; // Tambahkan HasFactory agar bisa menggunakan factory data

    protected $fillable = ['kode', 'total', 'status', 'kasir_id', 'bayar']; // Tambahkan 'kasir_id' & 'bayar'

    public function detilTransaksi()
    {
        return $this->hasMany(DetilTransaksi::class);
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id'); // Pastikan User.php ada di Models
    }
}

