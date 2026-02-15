<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Buat Aplikasi
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

// --- VERCEL FIX (Versi Aman) ---
// Kita gunakan try-catch agar kalau error tidak bikin mati total
try {
    if (isset($_ENV['VERCEL'])) {
        $path = '/tmp/storage';
        $app->useStoragePath($path);
        
        // Pastikan folder ada
        if (!is_dir($path . '/framework/views')) {
            mkdir($path . '/framework/views', 0777, true);
        }
    }
} catch (\Throwable $e) {
    // Diamkan saja kalau error, biar gak 500 fatal
}
// ------------------------------

return $app;