<?php

namespace App\Http\Middleware;

use Closure;

class AdminEmailIsVerified
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
        return $next($request);
    // dd($request->user('admin')->hasVerifiedEmail());


    // if (! $request->user('admin') || ($request->user('admin') instanceof Admin && 
    //         ! $request->user('admin')->hasVerifiedEmail())) {
    //     return $request->expectsJson()
    //         ? abort(403, 'Your email address is not verified.')
    //         : Redirect::route('admin.verification.notice');
    // }
    //     return $next($request);
    }
}
