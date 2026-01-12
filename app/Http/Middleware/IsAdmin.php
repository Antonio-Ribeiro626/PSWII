<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     * Kinda OBSULETO PORQUE JA TEMOS O RoleMiddleware
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
                return $next($request); 
    }

      abort(403, 'Acesso Negado. Apenas Administradores podem acessar a essa Area.');
    }
}
