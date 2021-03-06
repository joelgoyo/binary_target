<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (empty($request->referred_id)) {            
                return redirect(RouteServiceProvider::HOME);
            }
            
            if (Auth::user()->status == '5') {
                return redirect()->back()->with('Su usuario fue eliminado del sistema. Debe crearse un nuevo usuario para ingresar');
            }
        }

        return $next($request);
    }
}
