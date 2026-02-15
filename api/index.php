<?php

/*
|--------------------------------------------------------------------------
| VERCEL BYPASS: FORCE STORAGE SETUP
|--------------------------------------------------------------------------
| Kode ini akan memaksa pembuatan folder di /tmp (memori sementara)
| agar Laravel tidak error saat mencoba menulis file.
*/

$storage = '/tmp/storage';
$paths = [
    $storage . '/framework/views',
    $storage . '/framework/cache',
    $storage . '/framework/sessions',
    $storage . '/logs',
    $storage . '/app',
];

// 1. Buat folder-folder tersebut jika belum ada
foreach ($paths as $path) {
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
}

// 2. PAKSA konfigurasi Environment Variable (Menimpa .env)
// Ini memastikan Laravel membaca path yang benar-benar baru kita buat
putenv('APP_STORAGE=' . $storage);
putenv('VIEW_COMPILED_PATH=' . $storage . '/framework/views');
putenv('SESSION_DRIVER=array'); // Kita pakai array dulu biar aman (disimpan di RAM)
putenv('CACHE_STORE=array');    // Cache juga di RAM
putenv('LOG_CHANNEL=stderr');   // Log langsung ke Vercel

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/
require __DIR__ . '/../public/index.php';