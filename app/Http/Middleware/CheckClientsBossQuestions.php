<?php

namespace App\Http\Middleware;

use Closure;
use App\UserProfile;
use App\Result;

class CheckClientsBossQuestions
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
        // dd('Chchchchc');
        // dd(auth()->user()->id);
        $user_profile = UserProfile::where('user_id', auth()->user()->id)->first();
        // dd($user_profile->boss);

        if(!is_null($user_profile->boss) && !is_null($user_profile->clients)){
            // dd('Las dos preguntas han sido contestadas');
            return $next($request);
        }

        $boss = $user_profile->boss;
        $clients = $user_profile->clients;
        
        if(is_null($boss)){
            // dd($boss);
            // return dd('Reedirigir a pregunta si eres jefe');
            // return view('Employee/soloQuestion');
            return redirect()->route('initialQuestion', ['type' => 'jefe']);
            
        }
        
        if(is_null($clients)){
            // return dd('Reedirigir a pregunta si tratas con clientes');
            return redirect()->route('initialQuestion', ['type' => 'clientes']);

        }

        dd('Segun yo no es posible llegar a este mensaje por los if que estan escritos antes');

        return $next($request);

        // ---

        // $result = 

        
        

    }
}
