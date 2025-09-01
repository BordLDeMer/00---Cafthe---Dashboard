<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BypassPathEncoding
{
    /**
     * Handle an incoming request.
     * Cette version bypasse complètement toute validation d'encodage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Simplement passer la requête sans aucune validation
        // Cela désactive effectivement toute validation d'encodage de chemin
        return $next($request);
    }
}
