<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Administrador;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            abort(403);
        }

        $esAdmin = Administrador::where('user_id', auth()->id())->exists();

        if (!$esAdmin) {
            abort(403, 'No tienes permisos de administrador');
        }

        return $next($request);
    }
}


