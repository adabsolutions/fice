<?php

namespace App\Http\Middleware;

#use Illuminate\Foundation\Http\Middleware\HttpsProtocol as Middleware;
use Closure;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
            if (!$request->secure() && env('APP_ENV') === 'prod') {
                return redirect()->secure($request->getRequestUri());
            }

            return $next($request); 
    }
}
