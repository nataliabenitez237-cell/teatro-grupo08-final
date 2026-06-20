<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, $rol)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        
        // Validar según role_id (1 = admin, 2 = cliente)
        if ($rol == 'admin' && $user->rol_id != 1) {
            abort(403, 'No tenés permiso para acceder a esta página.');
        }
        
        if ($rol == 'cliente' && $user->rol_id != 2) {
            abort(403, 'No tenés permiso para acceder a esta página.');
        }

        return $next($request);
    }
}