<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Fungsi untuk mengambil semua data produk
    public function index()
    {
        // Ambil semua data product, sertakan juga info kategorinya
        $products = Product::with('category')->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Products',
            'data'    => $products
        ], 200);
    }
}