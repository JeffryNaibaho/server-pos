<?php

/*
|--------------------------------------------------------------------------
| VERCEL BYPASS: FORCE JSON & STORAGE
|--------------------------------------------------------------------------
*/

// 1. PAKSA LARAVEL JADI JSON (PENTING!)
// Ini menipu Laravel agar mengira browser minta JSON.
// Akibatnya: Laravel GAK AKAN pakai View Engine saat error.
$_SERVER['HTTP_ACCEPT'] = 'application/json';

// 2. Setup Folder Sementara (/tmp)
$storage = '/tmp/storage';

if (!is_dir($storage)) {
    mkdir($storage, 0777, true);
    mkdir($storage . '/framework', 0777, true);
    mkdir($storage . '/framework/views', 0777, true);
    mkdir($storage . '/framework/cache', 0777, true);
    mkdir($storage . '/framework/sessions', 0777, true);
    mkdir($storage . '/logs', 0777, true);
}

// 3. Inject Environment Variables
putenv('APP_STORAGE=' . $storage);
putenv('VIEW_COMPILED_PATH=' . $storage . '/framework/views');
putenv('SESSION_DRIVER=array'); 
putenv('CACHE_STORE=array');
putenv('LOG_CHANNEL=stderr');

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/
require __DIR__ . '/../public/index.php';