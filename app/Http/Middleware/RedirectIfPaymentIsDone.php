<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class RedirectIfPaymentIsDone
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
        if($company->access){
            return redirect()->route('empresa.index');
        }else{
            return $next($request);
        }
    }
}
