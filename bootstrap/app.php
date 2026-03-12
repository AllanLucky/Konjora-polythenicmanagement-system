<?php

use App\Http\Middleware\RoleMiddleware;
use App\Exceptions\Handler;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;

return Application::configure(basePath: dirname(__DIR__))

    /*
    |--------------------------------------------------------------------------
    | Routing Configuration
    |--------------------------------------------------------------------------
    */
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    /*
    |--------------------------------------------------------------------------
    | Middleware Configuration
    |--------------------------------------------------------------------------
    */
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);
    })

    /*
    |--------------------------------------------------------------------------
    | Exception Configuration
    |--------------------------------------------------------------------------
    */
    ->withExceptions(function (Exceptions $exceptions) {
        // Instead of passing Handler::class, use a callback if needed
        $exceptions->reportable(function (Throwable $e) {
            // Optionally delegate to Handler or log exceptions
            // Example: you can call custom logic from App\Exceptions\Handler here
            (new Handler(app()))->report($e);
        });
    })

    ->create();