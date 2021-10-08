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
        session_start();
        if(isset($_SESSION['cpf']) && $_SESSION['cpf'] != ''){
            return $next($request);
        }else{
            return redirect()->route('autenticacao', ['error' => 2]); 
        }
    }
}
