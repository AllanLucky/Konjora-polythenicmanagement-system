<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register exception handling callbacks.
     */
    public function register(): void
    {
        // Callback for reporting exceptions
        $this->reportable(function (Throwable $e) {
            // You can log certain exceptions here
        });

        // Callback for rendering exceptions
        $this->renderable(function (Throwable $e, $request) {
            // Handle 403 Unauthorized action from RoleMiddleware
            if ($e instanceof HttpException && $e->getStatusCode() === 403) {
                return response()->view('errors.403', [], 403);
            }

            // Optionally, handle other HTTP exceptions
            // if ($e instanceof HttpException && $e->getStatusCode() === 404) {
            //     return response()->view('errors.404', [], 404);
            // }
        });
    }
}