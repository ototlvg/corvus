<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class VerifyCompanyEmail
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
        // dd(Auth::guard('company')->user()->email_verified_at);
        $company = Auth::guard('company')->user();
        $verified = $company->email_verified_at;
        if(is_null($verified)){
            // dd('Se ha enviado un correo de confirmacion al correo: ' . $company->email);
            $email = $company->email;
            return redirect()->route('company.register.confirmation');
            // return view('Company.register.confirmation', compact('email'));
        }
        return $next($request);
    }
}
