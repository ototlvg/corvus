<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use App\User;

class CheckIfCompanyCanSeeResult
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
        // dd('dd');
        $company = Auth::guard('company')->user();
        $userid = $request->route()->parameter('user');
        $user = User::find($userid);

        if($user->company_id == $company->id){
            // dd('Esta empresa tiene acceso a este ususario');
            return $next($request);
        }else{
            abort(403);
            dd('Esta empresa no tiene acceso a este ususario');
        }
    }
}
