<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
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
            switch ($user->role){
                case 1:
                    return redirect()->route('superadmin.index');
                    break;
                case 2:
                    return redirect()->route('admin.index');
                    break;
                case 3:
                    return redirect()->route('manager.index');
                    break;
                case 4:
                    return redirect()->route('cashier.index');
                    break;
                case 5:
                    return redirect()->route('supplier.index');
                    break;
                default;
            }
        }else{
            return redirect()->route('login');
        }
    }
}
