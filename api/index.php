<?php

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);

try {
    // Ensure Vercel writable /tmp/cache directory exists
    if (!is_dir('/tmp/cache')) {
        @mkdir('/tmp/cache', 0755, true);
    }

    // Forward requests to the Laravel index.php file
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    // Log the actual error internally
    error_log($e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine() . "\n" . $e->getTraceAsString());

    // Output a clean 500 server error page to the user
    http_response_code(500);
    header('Content-Type: text/html; charset=utf-8');
    echo '<h1>500 Internal Server Error</h1>';
    echo '<p>Một lỗi hệ thống đã xảy ra. Vui lòng liên hệ quản trị viên.</p>';
}
