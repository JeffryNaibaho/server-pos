<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 1. Buat Aplikasi
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
*/
// Deteksi Vercel lewat environment variable
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    
    // Tentukan folder baru di memori sementara
    $path = '/tmp/storage';

    // PENTING: Paksa aplikasi menggunakan path ini
    $app->useStoragePath($path);

    // Buat struktur folder secara manual (Laravel tidak akan buatkan otomatis di sini)
    if (!is_dir($path . '/framework/views')) {
        mkdir($path . '/framework/views', 0777, true);
    }
    if (!is_dir($path . '/framework/cache')) {
        mkdir($path . '/framework/cache', 0777, true);
    }
    if (!is_dir($path . '/framework/sessions')) {
        mkdir($path . '/framework/sessions', 0777, true);
    }
    if (!is_dir($path . '/logs')) {
        mkdir($path . '/logs', 0777, true);
    }
}
// --------------------------------------------------------------------------

return $app;