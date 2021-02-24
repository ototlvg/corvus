<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

use App\Company;
use App\Notifications\ValidateEmailNotification;


class CompanyRegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/empresa/empresa';


    public function __construct()
    {
        // $this->middleware('guest:company');
    }

    public function show(){
        return view('Company.register.show');
    }

    public function register(Request $request)
    {
        // return $request->all(); // Es un array
        // $admin = Auth::guard('admin')->user();
        // return $admin->company_id;
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));


        
        // return 'Se creo users correctamente';

        // $this->guard('company')->login($user);

        // Auth::loginUsingId($user_id);

        $user->notify(new ValidateEmailNotification($user->email));

        $email = $user->email;


        // return redirect()->route('company.register.confirmation', ['email' => $email]);

        return view('Company.register.confirmation', compact('email'));

        // Auth::guard('company')->loginUsingId($user->id);

        // return $this->registered($request, $user)
        //                 ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return Company::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 2,
            'access' => 0,
        ]);

    }

    function base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    public function validateEmail($email){
        $emailDecoded = $this->base64url_decode($email);

        $company = Company::where('email', $emailDecoded)->first();

        if(!is_null($company->email_verified_at)){
            return redirect()->route('company.login');
        }

        $company->email_verified_at = now();
        $company->save();


        return redirect()->route('company.login');
    }

    public function confirmation(){
        $email = Auth::guard('company')->user()->email;
        return view('Company.register.confirmation', compact('email'));
    }
}
