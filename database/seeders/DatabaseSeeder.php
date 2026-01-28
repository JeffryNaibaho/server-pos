<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User untuk Login nanti
        User::create([
            'name' => 'Admin Kasir',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // Passwordnya 'password'
            'role' => 'admin',
        ]);

        // 2. Buat Kategori
        $catMakanan = Category::create([
            'name' => 'Makanan Ringan',
            'description' => 'Aneka snack dan cemilan',
        ]);

        $catMinuman = Category::create([
            'name' => 'Minuman Dingin',
            'description' => 'Minuman segar dari kulkas',
        ]);

        // 3. Buat Produk Dummy
        Product::create([
            'category_id' => $catMakanan->id,
            'name' => 'Chitato Sapi Panggang',
            'price' => 12500,
            'stock' => 50,
            'image' => 'https://via.placeholder.com/150', // Gambar placeholder
        ]);

        Product::create([
            'category_id' => $catMakanan->id,
            'name' => 'Oreo Vanilla',
            'price' => 8000,
            'stock' => 100,
            'image' => 'https://via.placeholder.com/150',
        ]);

        Product::create([
            'category_id' => $catMinuman->id,
            'name' => 'Aqua Botol 600ml',
            'price' => 3500,
            'stock' => 200,
            'image' => 'https://via.placeholder.com/150',
        ]);
        
        Product::create([
            'category_id' => $catMinuman->id,
            'name' => 'Teh Pucuk Harum',
            'price' => 4000,
            'stock' => 75,
            'image' => 'https://via.placeholder.com/150',
        ]);
    }
}