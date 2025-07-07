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

    // TAMBAHKAN LOGIKA BARU INI
    $middleware->redirectGuestsTo(function (Request $request) {
        // Jika rute yang coba diakses adalah rute admin...
        if ($request->routeIs('admin.*')) {
            // ...maka arahkan ke halaman login admin.
            return route('admin.login');
        }

        // Jika tidak, arahkan ke halaman login biasa.
        return route('login');
    });
})
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
