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
    Schema::create(table: 'transaksis', callback: function (Blueprint $table): void {
        $table->id();
        $table->string(column: 'kode');
        $table->integer(column: 'total');
        $table->string(column: 'status')->default(value: 'pending');
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
