<?php

// Polyfill for mb_strimwidth when mbstring extension is not enabled
if (!function_exists('mb_strimwidth')) {
    function mb_strimwidth($string, $start, $width, $trimmarker = '', $encoding = 'UTF-8') {
        $encoding = $encoding ?: 'UTF-8';
        if (function_exists('mb_substr')) {
            $length = mb_strlen($string, $encoding);
            if ($length <= $width) {
                return $string;
            }
            return mb_substr($string, $start, $width, $encoding) . $trimmarker;
        }
        $length = strlen($string);
        if ($length <= $width) {
            return $string;
        }
        return substr($string, $start, $width) . $trimmarker;
    }
}

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->validateCsrfTokens(except: [
            '/run-migrations',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e) {
            header('Content-Type: text/html; charset=utf-8');
            echo '<h1>Original Fatal Error</h1>';
            echo '<p><b>Error:</b> ' . htmlspecialchars($e->getMessage()) . '</p>';
            echo '<p><b>File:</b> ' . htmlspecialchars($e->getFile()) . ' on line ' . $e->getLine() . '</p>';
            echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
            exit;
        });
    })->create();
