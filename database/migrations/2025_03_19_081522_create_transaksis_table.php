<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique(); // Kode unik untuk transaksi
            $table->foreignId('kasir_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->decimal('total', 10, 2); // Menggunakan decimal agar nilai transaksi lebih akurat
            $table->enum('status', ['pending', 'selesai', 'batal'])->default('pending'); // Menambahkan pilihan status yang lebih lengkap
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
