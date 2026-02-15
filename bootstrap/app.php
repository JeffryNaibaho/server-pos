<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 1. Kita tampung dulu aplikasinya ke variabel $app (Jangan langsung di-return)
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

// 2. LOGIKA TAMBAHAN KHUSUS VERCEL
// Kita paksa aplikasi pindah 'rumah' (storage) ke folder /tmp
// Ini dilakukan SETELAH aplikasi dibuat, tapi SEBELUM dikembalikan ke sistem.
$app->useStoragePath('/tmp/storage');

// 3. Kembalikan aplikasi yang sudah dimodifikasi
return $app;