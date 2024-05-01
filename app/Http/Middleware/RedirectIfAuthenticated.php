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
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->hasRole()) {
                    if ($request->path() == 'admin' && Auth::user()->isAdmin()) {
                        return redirect()->route('admin.dashboard');
                    } else {
                        return redirect(RouteServiceProvider::DASHBOARD);
                    }
                } else {
                    return to_route('register.choose-plan');
                }
            }
        }

        return $next($request);
    }
}
