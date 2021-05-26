<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Language
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
      if(!Session::has('locale')){
            Session::put('locale', config('app.locale'));
        }
        app()->setLocale(session('locale'));

        return $next($request);
    }
}
