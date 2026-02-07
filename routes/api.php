<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TransactionController;

Route::get('/products', [ProductController::class, 'index']);
Route::post('/checkout', [TransactionController::class, 'store']);