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
        // return dd('dds');
        if (Auth::guard($guard)->check()) {
            // dd('dd');
            // return redirect(RouteServiceProvider::HOME);
            
            if($guard == 'admin'){
                // return redirect('/admin'); // La url directa
                return redirect()->route('admin.empresas.index');
            }elseif($guard == 'company'){
                return redirect()->route('empresa.index');
            }
            else{
                return redirect('/home');
            }
        }

        return $next($request);
    }
}
