<?php

// 1. Setup Folder /tmp (Wajib)
$tmpPath = '/tmp/storage/bootstrap/cache';
if (!is_dir($tmpPath)) {
    mkdir($tmpPath, 0777, true);
}

// 2. JURUS PEMINDAHAN (Crucial!)
// Kita beri tahu Laravel untuk menyimpan file cache paket & services di /tmp
// Ini menimpa perilaku default yang mencoba nulis ke folder asli (Read-Only)
putenv('APP_PACKAGES_CACHE=' . $tmpPath . '/packages.php');
putenv('APP_SERVICES_CACHE=' . $tmpPath . '/services.php');
putenv('APP_ROUTES_CACHE=' . $tmpPath . '/routes-v7.php');
putenv('APP_EVENTS_CACHE=' . $tmpPath . '/events.php');

// 3. Masuk ke Laravel
require __DIR__ . '/../public/index.php';