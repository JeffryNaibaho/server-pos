<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 1. Inisialisasi Aplikasi
$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

/*
|--------------------------------------------------------------------------
| VERCEL STORAGE FIX (LARAVEL 11)
|--------------------------------------------------------------------------
| Kode ini memaksa Laravel menggunakan folder /tmp untuk semua penyimpanan.
| Ini WAJIB untuk Vercel karena folder lain bersifat Read-Only.
*/

// Kita deteksi: Jika ada env VERCEL atau foldernya read-only, pindah ke /tmp
$isRunningOnVercel = isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || isset($_ENV['VERCEL_ENV']);

if ($isRunningOnVercel) {
    $storagePath = '/tmp/storage';
    
    // Daftar folder yang WAJIB dibuat
    $folders = [
        $storagePath,
        $storagePath . '/app',
        $storagePath . '/framework',
        $storagePath . '/framework/views',   // <-- INI YANG BIKIN ERROR MAKE('VIEW')
        $storagePath . '/framework/cache',
        $storagePath . '/framework/sessions',
        $storagePath . '/logs',
    ];

    // Buat foldernya jika belum ada
    foreach ($folders as $folder) {
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
    }

    // Perintahkan Laravel pindah rumah ke sini
    $app->useStoragePath($storagePath);
}
// --------------------------------------------------------------------------

// Kembalikan aplikasi yang sudah diperbaiki
return $app;