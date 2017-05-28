<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->cargo != "admin") {
            // No tiene el rol esperado!
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                flash('Acceso no autorizado.')->error();
                return redirect()->guest('/');
            }
        }
        return $next($request);
    }
}
