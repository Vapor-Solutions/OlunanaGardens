<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Log all exceptions with context
            if (!$e instanceof ValidationException) {
                Log::error('Application error', [
                    'exception' => get_class($e),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'url' => request()->fullUrl(),
                    'method' => request()->method(),
                    'user_id' => auth()->id(),
                    'ip' => request()->ip(),
                    'trace' => config('app.debug') ? $e->getTraceAsString() : 'Enable debug mode for trace',
                ]);
            }
        });

        // Handle specific exception types with custom logging
        $this->reportable(function (ModelNotFoundException $e) {
            Log::warning('Model not found', [
                'model' => $e->getModel(),
                'ids' => $e->getIds(),
                'url' => request()->fullUrl(),
                'user_id' => auth()->id(),
            ]);
        });

        $this->reportable(function (AuthenticationException $e) {
            Log::warning('Authentication failed', [
                'guards' => $e->guards(),
                'url' => request()->fullUrl(),
                'ip' => request()->ip(),
            ]);
        });

        // Handle validation errors for audit trail
        $this->reportable(function (ValidationException $e) {
            if (config('app.log_validation_errors', false)) {
                Log::info('Validation failed', [
                    'errors' => $e->errors(),
                    'url' => request()->fullUrl(),
                    'user_id' => auth()->id(),
                ]);
            }
        });
    }
}
