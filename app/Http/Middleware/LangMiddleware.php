<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LangMiddleware
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
        if($request->session()->has('myLocale') &&
            array_key_exists($request->session()->get('myLocale'),config('app.languages'))){
            app()->setLocale($request->session()->get('myLocale'));
        }
        else
            app()->setLocale(config('app.locale'));
        return $next($request);
    }
}
