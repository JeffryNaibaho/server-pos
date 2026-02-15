<?php

// 1. PAKSA MODE JSON (JURUS BUKA TOPENG)
// Dengan baris ini, Laravel tahu: "Oh, jangan render HTML cantik, cukup kasih teks JSON saja"
// Akibatnya: Laravel TIDAK AKAN mencari class 'View', dan error aslinya akan muncul.
$_SERVER['HTTP_ACCEPT'] = 'application/json';

// --- VERCEL DEBUGGER ---
try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    // Kalau masih crash juga, kita tangkap manual
    header('Content-Type: text/plain');
    http_response_code(500);
    
    echo "========================================================\n";
    echo "            PENYEBAB UTAMA (REAL ERROR)                 \n";
    echo "========================================================\n\n";
    
    echo "Pesan Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " (Baris " . $e->getLine() . ")\n";
    exit;
}