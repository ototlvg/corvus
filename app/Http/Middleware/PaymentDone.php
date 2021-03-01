<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;



class PaymentDone
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

        $access = $company->access;
        

        if($access){
            // return redirect()->route('company.payment.index');
            return $next($request);
        }else{
            return redirect()->route('company.payment.index');
        }

        dd($access);

        return $next($request);
    }
}
