<?php

// 1. Buat struktur folder di /tmp (Memori Sementara Vercel)
$storage = '/tmp/storage';
if (!is_dir($storage)) {
    mkdir($storage, 0777, true);
    mkdir($storage . '/framework/views', 0777, true);
    mkdir($storage . '/framework/cache', 0777, true);
    mkdir($storage . '/framework/sessions', 0777, true);
    mkdir($storage . '/logs', 0777, true);
}

// 2. Beri tanda bahwa kita sedang di Vercel
$_ENV['APP_RUNNING_IN_CONSOLE'] = false;
$_ENV['VERCEL'] = true;

// 3. Masuk ke Laravel
require __DIR__ . '/../public/index.php';