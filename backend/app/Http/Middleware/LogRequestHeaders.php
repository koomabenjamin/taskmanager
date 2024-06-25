<?php

namespace App\Http\Middleware;

use Closure;

class LogRequestHeaders
{
    public function handle($request, Closure $next)
    {
        // Log request headers
        $headers = $request->headers->all();
        logger()->info('Request Headers:', $headers);

        return $next($request);
    }
}
