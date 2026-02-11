<?php

// 1. Definisikan folder sementara di server Vercel (satu-satunya tempat yang bisa ditulisi)
$storage = '/tmp/storage';

// 2. Buat struktur folder penyimpanan secara manual jika belum ada
if (!is_dir($storage)) {
    mkdir($storage, 0777, true);
    mkdir($storage . '/framework/views', 0777, true);
    mkdir($storage . '/framework/sessions', 0777, true);
    mkdir($storage . '/framework/cache', 0777, true);
    mkdir($storage . '/logs', 0777, true);
}

// 3. PAKSA Laravel membaca konfigurasi ini (Menimpa .env dan config lainnya)
putenv('APP_STORAGE=' . $storage);
putenv('VIEW_COMPILED_PATH=' . $storage . '/framework/views');
putenv('SESSION_DRIVER=array'); // Kita ubah ke 'array' dulu biar TIDAK BUTUH file sama sekali
putenv('LOG_CHANNEL=stderr');   // Log langsung ke Vercel Output

// 4. Masuk ke Laravel
require __DIR__ . '/../public/index.php';