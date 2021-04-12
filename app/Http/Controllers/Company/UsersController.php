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
    public function index(Request $request)
    {

        $empleado = $request->get('empleado');

        
        // return $empleado;

        // return 'Hola';
        // return view('Admin.home');
        // $admin = Auth::guard('admin')->user();
        // $companyOfAdminId = $admin->company_id;

        $variablesReturning = [];



        $companyid = Auth::guard('company')->id();

        $company = Company::with('profile')->find($companyid);

        // $users = User::where('company_id', $companyid)->orderBy('id','DESC')->with('status')->paginate(10);
        
        
        
        if(!is_null($empleado)){
            // return Patient::where('name', 'LIKE' ,"%$search%")->orWhere('apaterno', 'LIKE' ,"%$search%")->orWhere('amaterno','LIKE',"%$search%")->paginate($this->paginationNumber);
            $users = User::where('company_id', $companyid)->where('name', 'LIKE' ,"%$empleado%")->orWhere('apaterno', 'LIKE' ,"%$empleado%")->orderBy('id','DESC')->with('status')->get();
            // return $users;
            // return 'Vacio';
        }else{
            $users = User::where('company_id', $companyid)->orderBy('id','DESC')->with('status')->paginate(10); // Si lee vas a cambiar de 10 recurda cambiar el 10 en el index al paginar
        }

        
        
        
        
        
        
        array_push($variablesReturning, 'users');
        array_push($variablesReturning, 'company');
        array_push($variablesReturning, 'userscount');
        
        // dd($users);

        $userscount = User::where('company_id',$companyid)->count();

        $men = $company->profile->men_workers;
        $women = $company->profile->women_workers;

        if($men!=0 && $women!=0 && $company->type==3){
            $totalWorkers = $men+$women;

            $womenPercentage = ($women)/$totalWorkers;
            $menPercentage = ($men)/$totalWorkers;

            // return $womenPercentage;

            $n = (0.9604*$totalWorkers) / ( ( 0.0025*($totalWorkers-1) ) + 0.9604 );
            $n = round($n, 0, PHP_ROUND_HALF_UP);

            $numberOfWomenWhoNeedsToTakeTheSurvey = round($n*$womenPercentage, 0, PHP_ROUND_HALF_UP);
            $numberOfMenWhoNeedsToTakeTheSurvey = round($n*$menPercentage, 0, PHP_ROUND_HALF_UP);
            
            $womenAlreadyRegistered= User::whereHas('profile',function($query) {
                $query->where('gender_id',2);
            })->where('company_id',$companyid)->count();
    
            $menAlreadyRegistered= User::whereHas('profile',function($query) {
                $query->where('gender_id',1);
            })->where('company_id',$companyid)->count();

            $numberOfWomenWhoNeedsToTakeTheSurvey = $numberOfWomenWhoNeedsToTakeTheSurvey-$womenAlreadyRegistered;
            $numberOfMenWhoNeedsToTakeTheSurvey = $numberOfMenWhoNeedsToTakeTheSurvey-$menAlreadyRegistered;
            
            
            // return view('Company.users.index', compact(['users', 'company','userscount','totalWorkers','numberOfWomenWhoNeedsToTakeTheSurvey','numberOfMenWhoNeedsToTakeTheSurvey']));

            array_push($variablesReturning, 'totalWorkers');
            array_push($variablesReturning, 'numberOfWomenWhoNeedsToTakeTheSurvey');
            array_push($variablesReturning, 'numberOfMenWhoNeedsToTakeTheSurvey');

        }
        // return $users;
        return view('Company.users.index', compact($variablesReturning));
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

        // return $data['name'];

        
        $this->createUserPack($data);
        // $this->createStatus($user,$company_type);

        $name = $data['name'] . ' ' . $data['apaterno'];
        // return $data['name'];

        return redirect()->route('users.index')->with(['stored'=>$name]);
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
        if(!empty($request['password'])){
            $this->validate($request, [
                'password'=> ['required', 'string', 'min:8'],
            ]);

            $user->password = Hash::make($request['password']);
            $user->save();
        }
        unset($request['password']);
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
        $user = User::find($id);

        $user->delete();
        // $user->save();

        return redirect()->route('users.index')->with(['deleted' => $user]);
    }

    public function importFromExcel(Request $request){
        // return 'holadsdasdasdsadsads';
        $this->validate($request, [
            'file'=> ['required', 'file', 'mimes:xlsx'],
        ]);


        $company = Auth::guard('company')->user();
        $companyid = $company->id;
        $company_type = $company->type;
        $companyDefaultPassword = $company->default_password_user;


        $availableGenders = array_map('strtoupper', Gender::orderBy('id', 'ASC')->pluck('gender')->toArray()  );
        $availableMaritals = array_map('strtoupper', Marital::orderBy('id', 'ASC')->pluck('status')->toArray()  );
        $availableEducation_levels = array_map('strtoupper', Education::orderBy('id', 'ASC')->pluck('name')->toArray() );
        $availableHiring_types = array_map('strtoupper', Hiring::orderBy('id', 'ASC')->pluck('name')->toArray() );
        $availableTurns = array_map('strtoupper', Turn::orderBy('id', 'ASC')->pluck('name')->toArray() );

        // return $availableEducation_levels;
        
        $gender_ids = Gender::orderBy('id', 'ASC')->get();
        $marital_ids = Marital::orderBy('id', 'ASC')->get();
        $education_level_ids = Education::orderBy('id', 'ASC')->get();
        $hiring_type_ids = Hiring::orderBy('id', 'ASC')->get();
        $turn_ids = Turn::orderBy('id', 'ASC')->get();
        
        // return $maritals;
        // return $availableGenders;

        $file = $request->file('file');
        $usersInit = Excel::toArray([], $file)[0]; // Obtener todos los alumnos
        $headersExcel = array_shift($usersInit); // Quitar la cabezera
        // return $usersInit;
        // return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($usersInit[0][4]));

        $users = [];
        $usersAdded = 0;
        $notAddedUsers = [];

        $flagNull = 0;

        $usersNotAddedBecauseEmailDuplicate = [];
        foreach($usersInit as $key=>$user){
            $flagCurrentNulls = 0;

            $complete = true;
            $u = $usersInit[$key];

            $headersWhoAreNull = [];
            for ($i=0; $i < count($u); $i++) { 
                $column = $u[$i];
                if(is_null($column)){
                    array_push($headersWhoAreNull, $headersExcel[$i]);
                    $complete = false;
                    $flagCurrentNulls++;
                    // $i = count($u)+1;
                    // return 'una columna esta vacia, esto no se anadira';
                }
                // return $column;
            }

            // return $flagCurrentNulls;

            if($complete){
                
                // array_push($users,$user);
                // return $usersInit[$key];
            
            
                
                // $newUserProfile = new UserProfile( ['birthday' => $birthday,'gender_id' => $u[5],'marital_id' => $u[6],'education_id' => $u[7],'job' => $u[8],'department' => $u[9],'hiring_type_id' => $u[10],'turn_id' => $u[11],'rotation' => $u[12],'current_work_experience' => $u[13],'work_experience' => $u[14]] );

                $gender = $u[5];
                $marital = $u[6];
                $education = $u[7];
                $hiring_type = $u[10];
                $turn = $u[11];

                // return array_search(strtoupper($gender), $availableGenders);

                $gender_key = array_search(strtoupper($gender), $availableGenders);
                $marital_key = array_search(strtoupper($marital), $availableMaritals);
                $education_key = array_search(strtoupper($education), $availableEducation_levels);
                $hiring_type_key = array_search(strtoupper($hiring_type), $availableHiring_types);
                $turn_key = array_search(strtoupper($turn), $availableTurns);

                // return $marital_key;

                if(!is_bool($gender_key) && !is_bool($marital_key) && !is_bool($education_key) && !is_bool($hiring_type_key) && !is_bool($turn_key)){
                    
                    $gender = $gender_ids[$gender_key]->id;
                    $marital = $marital_ids[$marital_key]->id;
                    $education = $education_level_ids[$education_key]->id;
                    $hiring_type = $hiring_type_ids[$hiring_type_key]->id;
                    $turn = $gender_ids[$turn_key]->id;

                    // return $turn;
                    
                    
                    $newUser = new User;
                    $newUser->name = $u[0];
                    $newUser->apaterno = $u[1];
                    $newUser->amaterno = $u[2];
                    $newUser->email = $u[3];
                    $newUser->password = $companyDefaultPassword;
                    $newUser->company_id = $companyid;
    
                    $genderX = $u[5];
    
                    // return array_search(strtoupper($genderX), $availableGenders);

                    // try {
                    //     //code...
                    //     $newUser->save();
                    // } catch (\Exception $e) {
                    //     return $e->message();
                    // }
                    
                    try {
                        //code...
                        $newUser->save();

                        $usersAdded++;
                        $birthday = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($u[4]));
                        $newUserProfile = new UserProfile( ['birthday' => $birthday, 'gender_id' => $gender ,'marital_id' => $marital,'education_id' => $education,'job' => $u[8],'department' => $u[9],'hiring_type_id' => $hiring_type,'turn_id' => $turn,'rotation' => $u[12],'current_work_experience' => $u[13],'work_experience' => $u[14]] );

                        $newUser->profile()->save($newUserProfile);


                        $this->createStatus($newUser, $company_type);
                    } catch (\Exception $e) {
                        // return $e->getCode();

                        if($e->getCode() == 23000){
                            // array_push($usersNotAddedBecauseEmailDuplicate, ['name' => "$u[0] $u[1] $u[2]", 'email' => $u[3] ]);                             
                            array_push($usersNotAddedBecauseEmailDuplicate,  $u[3]);                             
                        }else{
                            return 'xcxcxc';
                            return $e->getMessage();
                        }
                    }

                    
    
    
    
    
                    // $gender = $gender_ids[$gender_key]->id;
                    // $marital = $marital_ids[$marital_key]->id;
                    // $education = $education_level_ids[$education_key]->id;
                    // $hiring_type = $hiring_type_ids[$hiring_type_key]->id;
                    // $turn = $gender_ids[$turn_key]->id;
                                                                
                }


                // return $turn;


                // gender_id = $u[5]
                // marital_id = $u[6]
                // education_id = $u[7]
                // hiring_type_id = $u[10]
                // turn_id => $u[11]



                
                // return 'xx';

            }else{
                if($flagCurrentNulls == 15){
                    $flagNull++;
                    // return 'todos son null';
                    break;
                }else{
                    $object = (object) ['email' => $u[3], 'motive' => []];
                    $object->motive = $headersWhoAreNull;
                    // array_push($notAddedUsers, json_encode($object) );
                    array_push($notAddedUsers, $object );
                    
                }
            }

            
        }
        // return $users;
        // return $usersInit;
        // return $usersNotAddedBecauseEmailDuplicate;
        // return redirect()->route('users.index');

        $data2 = json_encode((array)$usersNotAddedBecauseEmailDuplicate);
        $data3 = json_encode((array)$notAddedUsers);
        // return $headersWhoAreNull;
        // return redirect()->back()->withErrors(['duplicate' => $usersNotAddedBecauseEmailDuplicate, 'notadded' => $notAddedUsers  ])->with('success',$usersAdded);
        return redirect()->back()->with([ 'success'=> $usersAdded, 'duplicate' => json_decode($data2, true), 'notadded' => json_decode($data3, true)]);
    }

    // public function createUserProfile(){

    // }
}
