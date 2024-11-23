<?php

namespace App\Http\Middleware;

use App\Constants;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsCashierMiddleware
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
            if($user->role == Constants::CASHIER && $user->store_id){
                return $next($request);
            }else{
                auth()->logout();
                return redirect()->route('login');
            }
        }else{
            auth()->logout();
            return redirect()->route('login');
        }
    }
}
