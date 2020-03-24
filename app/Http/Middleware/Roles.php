<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$par)
    {
        if(Auth::check()){
            if(in_array(Auth::user()->id_nivel, $par)){

                return $next($request);
            }else{
                $auth = Auth::user();
                if($auth->id_nivel === 1){
                    return redirect()->route('/');
                }else if($auth->id_nivel === 2){
                    return redirect()->route('fichas_academicas');
                }
            }
            
        }else{
            return redirect()->route('login');
        }
    }
}
