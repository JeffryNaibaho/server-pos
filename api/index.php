<?php

// --- VERCEL DEBUGGER ---
// Kita tangkap error apapun yang membuat Laravel crash
try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    // Jika ada error, tampilkan detail aslinya (Bukan Error 500 View)
    header('Content-Type: text/plain');
    http_response_code(500);
    
    echo "========================================================\n";
    echo "            PESAN ERROR ASLI TERTANGKAP!                \n";
    echo "========================================================\n\n";
    
    echo "Penyebab Utama: " . $e->getMessage() . "\n\n";
    echo "Lokasi File: " . $e->getFile() . " (Baris " . $e->getLine() . ")\n";
    
    echo "\n--------------------------------------------------------\n";
    echo "Stack Trace Singkat:\n";
    // Tampilkan 5 jejak terakhir saja biar tidak pusing
    $trace = $e->getTraceAsString();
    $lines = explode("\n", $trace);
    for ($i = 0; $i < 5; $i++) {
        echo (isset($lines[$i]) ? $lines[$i] : "") . "\n";
    }
    exit; // Matikan proses di sini
}