<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Penting untuk Database Transaction

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi data yang dikirim React
        $request->validate([
            'total_price' => 'required|integer',
            'items'       => 'required|array', // Daftar barang belanjaan
        ]);

        // Gunakan DB::transaction agar jika ada error di tengah jalan, semua batal (Safety)
        try {
            return DB::transaction(function () use ($request) {
                
                // A. Buat Header Transaksi
                $transaction = Transaction::create([
                    'user_id' => 1, // Kita hardcode ID Admin dulu (karena belum ada fitur login di React)
                    'invoice_code' => 'INV-' . time(), // Contoh: INV-1706430000
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

                    // C. KURANGI STOK (Fitur Utama)
                    $product = Product::find($item['id']);
                    $product->decrement('stock', $item['qty']);
                }

                // D. Kembalikan respons sukses
                return response()->json([
                    'success' => true,
                    'message' => 'Transaksi Berhasil!',
                    'data'    => $transaction
                ]);
            });

        } catch (\Exception $e) {
            // Jika error, kembalikan pesan error
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan transaksi: ' . $e->getMessage()
            ], 500);
        }
    }
}