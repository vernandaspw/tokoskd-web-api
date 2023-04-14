<?php

namespace App\Http\Middleware;

use App\Helpers\Resfor;
use Closure;
use Illuminate\Http\Request;

class AuthApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth('api')->check()) {
            return $next($request);
        }else {
            return Resfor::error(null, 'Unauthorization', 401);
        }
    }
}
