<?php

// Mengarah ke file bootstrap/app.php Laravel
$app = require __DIR__.'/../bootstrap/app.php';

// Menjalankan kernel HTTP
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);