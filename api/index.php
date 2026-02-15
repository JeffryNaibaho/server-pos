<?php

// 1. Setup Folder /tmp (Wajib untuk Vercel)
$tmpPath = '/tmp/storage/bootstrap/cache';
if (!is_dir($tmpPath)) {
    mkdir($tmpPath, 0777, true);
}

// 2. Cache Fix (Paket & Services)
putenv('APP_PACKAGES_CACHE=' . $tmpPath . '/packages.php');
putenv('APP_SERVICES_CACHE=' . $tmpPath . '/services.php');
putenv('APP_ROUTES_CACHE=' . $tmpPath . '/routes-v7.php');
putenv('APP_EVENTS_CACHE=' . $tmpPath . '/events.php');

// 3. --- JURUS ANTI-POTONG (PENTING!) ---
// Kita tipu Laravel: "Kamu jalan di /index.php, bukan /api/index.php"
// Dengan begini, Laravel TIDAK AKAN membuang kata '/api' dari alamat URL.
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

// 4. Masuk ke Laravel
require __DIR__ . '/../public/index.php';