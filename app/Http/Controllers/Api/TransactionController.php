<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB; // Kita matikan dulu sementara

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi data yang dikirim React
        $request->validate([
            'total_price' => 'required|integer',
            'items'       => 'required|array',
        ]);

        try {
            // --- KITA MATIKAN DB::transaction SEMENTARA ---
            // return DB::transaction(function () use ($request) {
                
                // A. Buat Header Transaksi
                $transaction = Transaction::create([
                    'user_id' => 1, 
                    'invoice_code' => 'INV-' . time(), 
                    'total_price' => $request->total_price,
                ]);

                // B. Loop setiap barang yang dibeli
                foreach ($request->items as $item) {
                    // Simpan ke Tabel Detail
                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'product_id'     => $item['id'],
                        'quantity'       => $item['qty'],
                        'price_at_transaction' => $item['price'],
                    ]);

                    // C. KURANGI STOK
                    $product = Product::find($item['id']);
                    if ($product) {
                        $product->decrement('stock', $item['qty']);
                    }
                }

                // D. Kembalikan respons sukses
                return response()->json([
                    'success' => true,
                    'message' => 'Transaksi Berhasil!',
                    'data'    => $transaction
                ]);
            // }); 
            // --- BATAS MATIKAN TRANSACTION ---

        } catch (\Exception $e) {
            // Kita akan langsung melihat ERROR ASLINYA di sini
            return response()->json([
                'success' => false,
                'message' => 'ERROR ASLI DITEMUKAN: ' . $e->getMessage()
            ], 500);
        }
    }
}