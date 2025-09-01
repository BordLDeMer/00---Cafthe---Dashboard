<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Client;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Http\Middleware\ValidatePathEncoding;
use App\Http\Middleware\ReplacePathEncodingMiddleware;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Kernel $kernel)
    {
        // Remplacer le middleware ValidatePathEncoding
        $kernel->setMiddlewareGroups(array_map(function ($middlewares) {
            return array_map(function ($middleware) {
                return $middleware === ValidatePathEncoding::class
                    ? ReplacePathEncodingMiddleware::class
                    : $middleware;
            }, $middlewares);
        }, $kernel->getMiddlewareGroups()));

        // Votre logique existante pour les vues
        View::composer('layouts.app', function ($view) {
            try {
                $clients = \App\Models\Client::limit(10)->get();
                $view->with('clients', $clients);
            } catch (\Exception $e) {
                \Log::error("Erreur dans le View Composer : " . $e->getMessage());
                $view->with('clients', collect());
            }
        });
    }
}
