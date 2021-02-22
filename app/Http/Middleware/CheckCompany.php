<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class CheckCompany
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
        $company = Auth::guard('company')->user();

        // dd();
        if(is_null($company->id)){
            return redirect()->route('empresa.index');
        }else{
            return $next($request);
        }

    }
}
