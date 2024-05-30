<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
class UserInsidenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->check() && substr(auth()->user()->id_user, 0, 2) === '10') {
            return $next($request); // Allow access if user insiden
        }elseif(auth()->check() && auth()->user()->is_admin == true){
            return $next($request);
        }else{
            return new Response('Unauthorized', 400);
        }
    }
}
