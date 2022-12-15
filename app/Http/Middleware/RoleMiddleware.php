<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{

    public function handle(Request $request, Closure $next, ...$roleNames)
    {
        if(Auth::check()){
            foreach ($roleNames as $roleName){
                if(Auth::user()->role->name == $roleName)
                    return $next($request);
            }

        }
        else {
            return redirect()->route('login.form');
        }

        return response()->view('errors.noperm');

    }

}
