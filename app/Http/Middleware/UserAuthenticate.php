<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        dd($request);
        if(isset($_SESSION['login']) && $_SESSION['login'] != ''){
            session_start();
            return $next($request);
        }else{
            return redirect()->route('autenticacao', ['error' => 2]);
        }
    }
}
