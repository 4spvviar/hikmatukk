<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthOperator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()){
            return redirect('/auth/login');
        }
        if (Auth::user()->role === 'member'){
            return $next($request);
        }
        if (Auth::user()->role === 'admin'){
            return redirect()->route('admin.dashboard');
        }

        Auth::logout();
        {
            return redirect('/auth/login')->with('error', 'role tidak valid');
        }
    }
}
