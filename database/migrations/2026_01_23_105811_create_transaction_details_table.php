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
    Schema::create('transaction_details', function (Blueprint $table) {
        $table->id();
        // Relasi ke tabel transactions
        $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
        
        // Relasi ke tabel products
        $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
        
        $table->integer('quantity'); // Jumlah beli
        $table->integer('price_at_transaction'); // Harga saat dibeli (PENTING!)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
