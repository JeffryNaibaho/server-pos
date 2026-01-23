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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        // Mencatat siapa kasir yang melayani (Relasi ke tabel users)
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
        $table->string('invoice_code')->unique(); // Contoh: INV-001
        $table->integer('total_price'); // Total belanja
        $table->timestamps(); // Mencatat tanggal transaksi (created_at)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
