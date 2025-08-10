<?php

use App\Shared\Exceptions\EntityNotFoundError;
use App\Shared\Exceptions\ForbiddenError;
use App\Shared\Exceptions\InvalidCredentialsError;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (EntityNotFoundError $e, $request) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        });
        $exceptions->render(function (InvalidCredentialsError $e, $request) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 401);
        });
        $exceptions->render(function (ForbiddenError $e, $request) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 403);
        });
})->create();
