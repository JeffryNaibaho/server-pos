<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        // --- JURUS BUKA TOPENG ERROR ---
        // Kita paksa semua error ditampilkan sebagai Teks Polos (Plain Text).
        // Ini mem-bypass kebutuhan akan "View" engine yang rusak di Vercel.
        $exceptions->render(function (Throwable $e, Request $request) {
            
            // Format pesan error yang jujur & brutal
            $content = "=== ERROR ASLI TERUNGKAP ===\n\n";
            $content .= "Pesan: " . $e->getMessage() . "\n";
            $content .= "File: " . $e->getFile() . " (Baris " . $e->getLine() . ")\n\n";
            $content .= "Stack Trace:\n" . $e->getTraceAsString();
            
            return new Response($content, 500, ['Content-Type' => 'text/plain']);
        });
    })->create();

// 2. VERCEL STORAGE FIX (Tetap kita pasang untuk jaga-jaga)
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $path = '/tmp/storage';
    $app->useStoragePath($path);
    
    // Bikin folder manual biar gak rewel
    $dirs = ['/framework/views', '/framework/cache', '/framework/sessions', '/logs'];
    foreach ($dirs as $dir) {
        if (!is_dir($path . $dir)) mkdir($path . $dir, 0777, true);
    }
}

return $app;