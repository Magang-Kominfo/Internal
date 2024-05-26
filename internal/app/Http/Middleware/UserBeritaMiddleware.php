<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserBeritaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && substr(auth()->user()->id_user, 0, 2) === '20') {
            return $next($request); // Allow access if user aset
        }elseif(auth()->check() && auth()->user()->is_admin == true){
            return $next($request);
        }else{
            return new Response('Unauthorized', 400);
        }
    }
}
