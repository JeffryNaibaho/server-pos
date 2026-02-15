<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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

// VERCEL STORAGE FIX
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $path = '/tmp/storage';
    $app->useStoragePath($path);
    
    // Buat folder storage manual
    $dirs = ['/framework/views', '/framework/cache', '/framework/sessions', '/logs'];
    foreach ($dirs as $dir) {
        if (!is_dir($path . $dir)) mkdir($path . $dir, 0777, true);
    }
}

return $app;