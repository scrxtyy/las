<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && (auth()->user()->usertype === 'SuperAdmin' || auth()->user()->usertype === 'admin')) {
                return redirect(RouteServiceProvider::HOME);
            }else if(Auth::guard($guard)->check() && (auth()->user()->usertype === 'employee'))
            {
                return redirect('/employee');
            }
        }

        return $next($request);
    }
}
