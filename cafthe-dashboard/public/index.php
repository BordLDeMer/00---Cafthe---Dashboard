<?php

// Désactiver le middleware ValidatePathEncoding
if (!defined('LARAVEL_START')) {
    $middlewareFile = __DIR__.'/../vendor/laravel/framework/src/Illuminate/Http/Middleware/ValidatePathEncoding.php';

    if (file_exists($middlewareFile)) {
        $content = file_get_contents($middlewareFile);

        // Vérifiez si le fichier a déjà été modifié pour éviter les doublons
        if (strpos($content, 'public function handle($request, Closure $next) { return $next($request); }') === false) {
            $content = str_replace(
                'public function handle($request, Closure $next)',
                'public function handle($request, Closure $next) { return $next($request); } //',
                $content
            );

            file_put_contents($middlewareFile, $content);
        }
    }
}

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = \Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);
