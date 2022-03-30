<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticatedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        if(session('login') !== null && session('login') != ''){
            session();
            return $next($request);
        }else{
            return redirect()->route('autenticacao', ['error' => 2]);
        }
    }
}
