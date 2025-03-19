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
    Schema::create(table: 'detil_transaksis', callback: function (Blueprint $table): void {
        $table->id();
        $table->foreignId(column: 'transaksi_id')->constrained(table: 'transaksis')->onDelete(action: 'cascade');
        $table->foreignId(column: 'produk_id')->constrained(table: 'produks')->onDelete(action: 'cascade');
        $table->integer(column: 'jumlah');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detil_transaksis');
    }
};
