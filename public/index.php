<?php
// public/index.php

// Set base path for includes
$baseDir = dirname(__DIR__);

// Autoload core classes (simple autoloader)
spl_autoload_register(function ($class) use ($baseDir) {
    $paths = [
        '/app/core/',
        '/app/controllers/',
        '/app/models/'
    ];
    foreach ($paths as $path) {
        $file = $baseDir . $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Start session securely
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure' => isset($_SERVER['HTTPS']),
        'cookie_samesite' => 'Strict',
    ]);
}

// Load config
require_once $baseDir . '/app/core/config.php';

// Route the request
$app = new App();
