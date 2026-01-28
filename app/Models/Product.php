<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // 1. Izinkan kolom ini diisi (Mass Assignment)
    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'price',
        'stock',
        'image',
        'description',
    ];

    // 2. Definisi Relasi: Product -> Category
    public function category()
    {
        // Artinya: Produk ini milik Category
        return $this->belongsTo(Category::class);
    }
}