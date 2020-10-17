<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Status;
use App\UserProfile;
use App\Company;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        // return $request->all(); // Es un array
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        
        // return 'Se creo users correctamente';
        
        $this->createUserProfile($request->all(), $user->id);
        $this->createStatus($user);

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
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
            'apaterno' => ['required', 'string  ']
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
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     'apaterno' => $data['apaterno']
        // ]);
        
        // return User::create([
        //     'name' => $data['name'],
        //     'apaterno' => $data['apaterno'],
        //     'amaterno' => $data['amaterno'],
        //     'birthday' => $data['birthday'],
        //     'gender' => $data['gender'],
        //     'marital' => $data['marital'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);

        return User::create([
            'name' => $data['name'],
            'apaterno' => $data['apaterno'],
            'amaterno' => $data['amaterno'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // $user = new User();
        // $user->name = $data['name'];
        // $user->apaterno = $data['apaterno'];
        // $user->amaterno = $data['amaterno'];
        // $user->birthday = $data['birthday'];
        // $user->gender = $data['gender'];
        // $user->marital = $data['marital'];
        // $user->email = $data['email'];
        // $user->password = Hash::make($data['password']);
        // return $user;
    }

    public function createStatus($user){

        $company_type = Company::first()->type;

        for($i=1; $i<=$company_type; $i++){
            $status = new Status();
            if($company_type == 3 && $i==2){
                $status->survey_id = 3;
                $i=4;
            }else{
                $status->survey_id = $i;
            }
            $status->user_id = $user->id;
            $status->save();
        }

    }

    public function createUserProfile(array $data, $id){
        return UserProfile::create([
            'user_id' => $id,
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'marital' => $data['marital'],
        ]);
    }
}
