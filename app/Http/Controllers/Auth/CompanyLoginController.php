<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Nuevo
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;


class CompanyLoginController extends Controller
{
    use RedirectsUsers, ThrottlesLogins; // Agregados para Limitar el numero de Intentos

    public function __construct()
    {
        // $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm(){
        return view('auth.login_company');
    }

    public function login(Request $request){

        // Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
         ]);

         // Limitar el intento de Accesos
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // Attempt to log the user in
        if(Auth::guard('company')->attempt(['email'=>$request->email, 'password' => $request->password], $request->remember)){
            // return redirect()->intended(route('admin.dashboard'));
            // return redirect()->intended(route('users.index'));
            return 'Accedio correctamente';
        }

        // return redirect()->back()->withInput($request->only('email')); // If unsuccesfull, the redirect to their intendet location

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request); // tttl

        return $this->sendFailedLoginResponse($request);

    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }


    public function username()
    {
        return 'email';
    }

    public function logout()
    {
        Auth::guard('company')->logout();
        return redirect('/');
    }
}
