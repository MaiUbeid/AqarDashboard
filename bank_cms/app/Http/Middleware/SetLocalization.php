<?php

namespace App\Http\Middleware;

use Closure;
use App;

class SetLocalization
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

        $locale = '';
        $locales = ['ar','en'];

        $request_uri = $this->getRedirectPath($request);

        if($request->hasCookie('locale')) {
         $locale = $request->cookie('locale');         
        if(in_array($request->segment(1),$locales)){
         $locale = $request->segment(1);   
         }
        }

        else{
        if(in_array($request->segment(1),$locales)){    
         $locale = $request->segment(1);   
         }
        }

        
        if(!in_array($locale, $locales))
         $locale = 'ar';

        App::setLocale($locale);

        if(!in_array($request->segment(1),$locales)){
        $request_uri = $locale . '/' . $this->getRedirectPath($request);
        return redirect($request_uri)->withCookie(cookie()->forever('locale', $locale));
        }

        $response = $next($request);
        return $response->withCookie(cookie()->forever('locale', $locale));
    }


    private function getRedirectPath($request): string
    {
        return $request->path() . ($request->getQueryString() ? '?' . $request->getQueryString() : '');
    }








}