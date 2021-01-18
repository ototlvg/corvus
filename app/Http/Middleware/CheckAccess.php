<?php

namespace App\Http\Middleware;

use Closure;
use App\Company;

class CheckAccess
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
        $company = Company::first();

        if(empty($company)){
            dd('No existe compañia registrada');
        }


        $access = $company->access;
        // $message = $access ? 'Concedido' : 'No tiene acceso';
        // return dd($message);

        

        if(!$access){
            dd('No tienes autorizacion');
        }else{

            return $next($request);
        }
    }
}
