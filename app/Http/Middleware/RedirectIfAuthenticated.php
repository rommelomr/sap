<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $auth = Auth::user();
            if ($auth->id_nivel === 1){

                return redirect()->route('users');
                
            }else if ($auth->id_nivel === 2){
                return redirect()->route('fichas_academicas');
            }
        }

        return $next($request);
    }
}
