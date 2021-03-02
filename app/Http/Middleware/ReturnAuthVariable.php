<?php

namespace App\Http\Middleware;

use Closure;

use View;
use Illuminate\Support\Facades\Auth;

class ReturnAuthVariable
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
        View::share('companyGlobal', $company);
        // dd($company);
        return $next($request);
    }
}
