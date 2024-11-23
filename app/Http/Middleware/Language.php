<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if($user){
            if($user->language){
                $locale = $user->language;
            }else{
                $locale = env('DEFAULT_LANGUAGE','ru');
            }
        }else{
            $locale = env('DEFAULT_LANGUAGE','ru');
        }
        App::setLocale($locale);
        return $next($request);
    }
}
