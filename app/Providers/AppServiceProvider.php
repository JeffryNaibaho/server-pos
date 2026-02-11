<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // --- TAMBAHAN KHUSUS VERCEL ---
        // Cek jika folder penyimpanan sementara belum ada, buat sekarang juga!
        $viewPath = '/tmp/storage/framework/views';
        
        if (!is_dir($viewPath)) {
            mkdir($viewPath, 0777, true);
        }
        
        // Paksa Laravel menggunakan folder tersebut
        config(['view.compiled' => $viewPath]);
        // ------------------------------
    }
}
