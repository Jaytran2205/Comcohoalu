<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

try {
    // Forward requests to the Laravel index.php file
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    header('Content-Type: text/html; charset=utf-8');
    echo '<h1>Laravel Boot Fatal Error on Vercel</h1>';
    echo '<p><b>Error:</b> ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p><b>File:</b> ' . htmlspecialchars($e->getFile()) . ' on line ' . $e->getLine() . '</p>';
    echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
}
