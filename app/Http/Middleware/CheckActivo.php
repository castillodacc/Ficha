<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckActivo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $response = $next($request);
        if(Auth::check() AND !$request->user()->activo) {
            return redirect('home')->withErrors(['inactivo' => ['Usuario bloqueado.']]);
        }
        return $next($request);
        // return $response;
    }
}
