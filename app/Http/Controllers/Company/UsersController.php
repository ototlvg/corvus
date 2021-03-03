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

use App\Education;
use App\Gender;
use App\Hiring;
use App\Marital;
use App\Turn;


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

    // public function createUserProfile(array $data, $id){
    //     return UserProfile::create([
    //         'user_id' => $id,
    //         'birthday' => $data['birthday'],
    //         'gender' => $data['gender'],
    //         'marital' => $data['marital'],

    //         'education' => $data['education'],
    //         'job' => $data['job'],
    //         'department' => $data['department'],
    //         'hiring_type' => $data['hiring_type'],
    //         'turn' => $data['turn'],
    //         'rotation' => $data['rotation'],
    //         'current_work_experience' => $data['current_work_experience'],
    //         'work_experience' => $data['work_experience']
    //     ]);
    // }

    public function createUserPack($data){
        
        $company = Auth::guard('company')->user();
        $companyid = $company->id;
        $company_default_password_user = $company->default_password_user;
        $company_type = $company->type;
        
        $newUser = new User;
        $newUser->name = $data['name'];
        $newUser->apaterno = $data['apaterno'];
        $newUser->amaterno = $data['amaterno'];
        $newUser->email = $data['email'];
        $newUser->password = $company_default_password_user;
        $newUser->company_id = $companyid;
        $newUser->save();
        
        // $birthday = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data['birthday']));
                    // $birthday = $u[4];
                    // $birthday = $u[4];
        $newUserProfile = new UserProfile( [
            'birthday' => $data['birthday'],
            'gender_id' => $data['gender'],
            'marital_id' => $data['marital'],
            'education_id' => $data['education'],
            'job' => $data['job'],
            'department' => $data['department'],
            'hiring_type_id' => $data['hiring_type'],
            'turn_id' => $data['turn'],
            'rotation' => $data['rotation'],
            'current_work_experience' => $data['current_work_experience'],
            'work_experience' => $data['current_work_experience']
        ] );

        $newUser->profile()->save($newUserProfile);

        $this->createStatus($newUser,$company_type);
        

        // 'name' => $data['name'],
        // 'apaterno' => $data['apaterno'],
        // 'amaterno' => $data['amaterno'],
        // 'email' => $data['email'],
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Auth::guard('company')->user();

        $genders = Gender::all();

        $maritals = Marital::all();

        $education_levels = Education::all();

        $hiring_types = Hiring::all();

        $turns = Turn::all();

        return view('Company.users.create', compact(['company','genders','maritals','education_levels','hiring_types','turns']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = Auth::guard('company')->user();
        $companyid = $company->id;
        $company_type = $company->type;

        
        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     'apaterno' => ['required', 'string'],
        //     'company' => ['required', 'numeric'],
        // ]);

        $data = $request->all();

        
        $this->createUserPack($data);
        // $this->createStatus($user,$company_type);

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
        $user = User::where('company_id', $companyid)->with('profile.education','profile.gender','profile.hiring_type','profile.marital','profile.turn')->find($id);

        
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
    //    return $user;
    //    $genders = ['Masculino','Femenino'];
    //    $marital = ['Casado', 'Soltero', 'Union libre', 'Divorciado', 'Viudo'];

        $company = Auth::guard('company')->user();

        $genders = Gender::all();

        $maritals = Marital::all();

        $education_levels = Education::all();

        $hiring_types = Hiring::all();

        $turns = Turn::all();

        // compact(['company','genders','maritals','education_levels','hiring_types','turns'])
       
        return view('Company.users.edit',compact(['user', 'company','genders','maritals','education_levels','hiring_types','turns']));
        
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
        
        $this->validate($request, [
            'name'=> ['required', 'string', 'max:255'],
            'apaterno' => ['required', 'string', 'max:255'],
            'amaterno' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
            'gender_id' => ['required', 'numeric'],
            'marital_id' => ['required', 'numeric'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'education_id' => ['required', 'numeric'],
            'job' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'hiring_type_id' => ['required', 'numeric'],
            'turn_id' => ['required', 'numeric'],
            'rotation' => ['required'],
            'current_work_experience' => ['required', 'numeric'],
            'work_experience' => ['required', 'numeric'],
        ]);

        $user = User::find($id);
        $user->update($request->all());
        // $user->profile()->update(['gender_id'=>$request->post('gender_id')]);
        $user->profile()->update(
            [
                'birthday' => $request->post('birthday'),
                'gender_id' => $request->post('gender_id'),
                'marital_id' => $request->post('marital_id'),
                'education_id' => $request->post('education_id'),
                'job' => $request->post('job'),
                'department' => $request->post('department'),
                'hiring_type_id' => $request->post('hiring_type_id'),
                'turn_id' => $request->post('turn_id'),
                'rotation' => $request->post('rotation'),
                'current_work_experience' => $request->post('current_work_experience'),
                'work_experience' => $request->post('work_experience'),
            ]
        );

    
        // return $request->all();
        return redirect()->route('users.edit',$user->id)->with(['saved' => true]);
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
                    $newUserProfile = new UserProfile( ['birthday' => $birthday,'gender_id' => $u[5],'marital_id' => $u[6],'education_id' => $u[7],'job' => $u[8],'department' => $u[9],'hiring_type_id' => $u[10],'turn_id' => $u[11],'rotation' => $u[12],'current_work_experience' => $u[13],'work_experience' => $u[14]] );

                    $newUser->profile()->save($newUserProfile);


                    $this->createStatus($newUser, $company_type);


                    
                    // return 'xx';
                }

            }
        }
        // return $users;
        return redirect()->route('users.index');
    }

    // public function createUserProfile(){

    // }
}
