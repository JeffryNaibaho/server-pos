<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // --- BAGIAN INI YANG TADI KURANG ---
    protected $fillable = [
        'user_id',
        'invoice_code',
        'total_price'
    ];

    // Relasi (Opsional, tapi bagus untuk disiapkan)
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}