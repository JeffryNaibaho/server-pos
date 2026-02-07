<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/run-migration', function () {
    Artisan::call('migrate:fresh --seed --force');
    
    return '✅ Database berhasil di-FRESH (Wipe Clean) dan diisi data dummy!';
});