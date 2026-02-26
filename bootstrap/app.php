<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Log exception message to stderr so it appears in Render logs (even when APP_DEBUG=false)
        $exceptions->report(function (\Throwable $e) {
            if (php_sapi_name() !== 'cli') {
                error_log('[Laravel 500] ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
            }
        });
    })->create();