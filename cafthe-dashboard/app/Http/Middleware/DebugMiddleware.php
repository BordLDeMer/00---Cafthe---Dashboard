<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DebugMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        \Log::debug('Request URL: ' . $request->fullUrl());
        \Log::debug('Request Path: ' . $request->path());
        \Log::debug('Request Method: ' . $request->method());
        \Log::debug('Request Input: ', $request->all());

        return $next($request);
    }
}
