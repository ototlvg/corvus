<?php

namespace App\Http\Middleware;

use Closure;
use App\UserProfile;

class checkAccessForInitialQuestion
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
        $user_profile = UserProfile::where('user_id', auth()->user()->id)->first();
        // dd($user_profile->boss);

        if(!is_null($user_profile->boss) && !is_null($user_profile->clients)){
            // dd('Las dos preguntas han sido contestadas');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
