<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevisarEstablecimiento
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // este middleware es para garantizar que las personas solo tengan y establecimiento registrado,
        // no me gusta la opcion pero es mas por practica
        if(Auth()->user()->establecimientos) {
            return redirect('/establecimiento/edit');
        }
        return $next($request);
    }
}
