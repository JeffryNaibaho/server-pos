<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/run-migration', function () {
    // Jalankan migrate:refresh --seed dengan force (karena di production)
    Artisan::call('migrate:refresh --seed --force');
    return '✅ Database berhasil di-reset dan diisi data dummy!';
});
