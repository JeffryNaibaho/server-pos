<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 1. Setup Aplikasi
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

// 2. VERCEL STORAGE FIX
// Ini logika paling aman: Jika folder default tidak bisa ditulis, pindah ke /tmp
try {
    $defaultPath = $app->storagePath();
    if (!is_writable($defaultPath)) {
        // Pindah ke /tmp/storage
        $app->useStoragePath('/tmp/storage');
        
        // Buat folder penting di /tmp jika belum ada
        $dirs = [
            '/tmp/storage/framework/views',
            '/tmp/storage/framework/cache',
            '/tmp/storage/framework/sessions',
            '/tmp/storage/logs'
        ];
        
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
        }
    }
} catch (\Throwable $e) {
    // Diamkan error permission agar tidak crash 500
}

return $app;