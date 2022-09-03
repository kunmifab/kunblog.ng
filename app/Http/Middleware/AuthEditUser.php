<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthEditUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->check()){
            return abort(401);
        }
        $user = auth()->user()->role->id;

        if($user == 1 || $user == 2 || $user == 3){
            return $next($request);
        }else{
            return abort(401);
        }

    }
}
