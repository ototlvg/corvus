<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Result;
use App\ResultTrauma;
use App\Category;

use App\Status;
use App\UserProfile;
use App\Admin;
use App\Company;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:company');
        $this->middleware('email.verified.company');

        $this->middleware('CheckIfCompanyCanSeeResult', [ 'except' => [ 'index', 'create', 'store', 'importFromExcel'] ]);

        $this->middleware('PaymentDone');

        $this->middleware('ReturnAuthVariable');

        
        // $this->middleware('checkCompany');
        // $this->middleware('checkAccess');
        // $this->middleware('checkClientsBossQuestions');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'Hola';
        // return view('Admin.home');
        // $admin = Auth::guard('admin')->user();
        // $companyOfAdminId = $admin->company_id;
        $company = Auth::guard('company')->user();
        $companyid = $company->id;

        // return $admin;
        // $users = User::where('company_id', $companyOfAdminId)->paginate(1);
        $users = User::where('company_id', $companyid)->with('status')->paginate(10);
        // return $users;
        // dd($admin);
        // return $admin;
        // return $users;
        return view('Company.users.index', compact(['users']));
    }

    public function createStatus($user, $company_type){

        // $company_type = $user->company_id;

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

            'education' => $data['education'],
            'job' => $data['job'],
            'department' => $data['department'],
            'hiring_type' => $data['hiring_type'],
            'turn' => $data['turn'],
            'rotation' => $data['rotation'],
            'current_work_experience' => $data['current_work_experience'],
            'work_experience' => $data['work_experience']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Auth::guard('company')->user();
        // $companyid = $company->id;
        // return $company;

        return view('Company.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $company = Auth::guard('company')->user();
        $companyid = $company->id;

        // $company = Company::find($companyid);
        $company_type = $company->type;

        // return $company_type;

        // return $company->password;
        
        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     'apaterno' => ['required', 'string'],
        //     'company' => ['required', 'numeric'],
        // ]);

        // $user = $this->create($request->all());
        $data = $request->all();

        // return $data;



        $user = User::create([
            'name' => $data['name'],
            'apaterno' => $data['apaterno'],
            'amaterno' => $data['amaterno'],
            'email' => $data['email'],
            'password' => '$2y$10$2l.roApUvp9.to/Dj/BkL.1RdR0HnH1hlywU9qVslkJDe.5MhkCT6',
            'company_id' => $companyid

            // 'education' => $data['education'],
            // 'job' => $data['job'],
            // 'department' => $data['department'],
            // 'hiring_type' => $data['hiring_type'],
            // 'turn' => $data['turn'],
            // 'rotation' => $data['rotation'],
            // 'current_work_experience' => $data['current_work_experience'],
            // 'work_experience' => $data['work_experience']
            
        ]);

        $this->createUserProfile($request->all(), $user->id);
        $this->createStatus($user,$company_type);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Auth::guard('company')->user();
        $companyid = $company->id;
        $user = User::where('company_id', $companyid)->with('profile')->find($id);

        
        // return $user;
        return view('Company.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user = User::with('profile')->find($id);
       $genders = ['Masculino','Femenino'];
       $marital = ['Casado', 'Soltero', 'Union libre', 'Divorciado', 'Viudo'];
       
       return view('Company.users.edit',compact(['user', 'genders', 'marital']));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function importFromExcel(Request $request){
        // return 'hola';


        $company = Auth::guard('company')->user();
        $companyid = $company->id;
        $company_type = $company->type;

        $file = $request->file('file');
        $usersInit = Excel::toArray([], $file)[0]; // Obtener todos los alumnos
        array_shift($usersInit); // Quitar la cabezera
        // return $usersInit;
        // return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($usersInit[0][4]));

        $users = [];
        foreach($usersInit as $key=>$user){
            if(!is_null($user[0])){
                array_push($users,$user);
                // return $usersInit[$key];
                $u = $usersInit[$key];

                if(!is_null($u[3]) && !is_null($u[5])){
                    $newUser = new User;
                    $newUser->name = $u[0];
                    $newUser->apaterno = $u[1];
                    $newUser->amaterno = $u[2];
                    $newUser->email = $u[3];
                    $newUser->password = Hash::make('password123-');
                    $newUser->company_id = $companyid;
                    $newUser->save();

                    $birthday = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($u[4]));
                    // $birthday = $u[4];
                    // $birthday = $u[4];
                    $newUserProfile = new UserProfile( ['birthday' => $birthday,'gender' => $u[5],'marital' => $u[6],'education' => $u[7],'job' => $u[8],'department' => $u[9],'hiring_type' => $u[10],'turn' => $u[11],'rotation' => $u[12],'current_work_experience' => $u[13],'work_experience' => $u[14]] );

                    $newUser->profile()->save($newUserProfile);


                    $this->createStatus($newUser, $company_type);


                    
                    // return 'xx';
                }

            }
        }
        // return $users;
        return redirect()->route('users.index');
    }
}
