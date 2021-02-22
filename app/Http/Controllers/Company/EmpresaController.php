<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Admin;
use App\Company;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:company');
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
        // $admin = Auth::guard('admin')->user()->with('company')->first();
        // return 'hhola';
        $company = Auth::guard('company')->user();

        // return $admin;
        $companyid = $company->id;

        // Para no generar error
        $answered = null;
        $usersCount = null;

        if(is_null($companyid)){
            $flag = 0;
            return view('Admin.empresa.index', compact('answered','usersCount', 'company', 'flag'));
        }else{
            $flag = 1;

            // $admin = Admin::with('company')->find($admin->id);
            // $company = $admin->company;
            // return $admin;
            // return view('Admin.empresa.index', compact('answered','usersCount', 'company', 'flag'));
            // return $flag;
    
            // return view('Admin.empresa.index', compact('answered','usersCount', 'company', 'flag'));
    
            $users = User::where('company_id',$companyid)->with('status')->get();
            
            // return $users;
            $firstSurveyAnswered = [];
            $secondSurveyAnswered = [];
            for ($i=0; $i < count($users); $i++) { 
                $user = $users[$i];
    
                foreach ($user->status as $key => $s) {
                    if($s->survey_id == 1 && $s->answered){
                        array_push($firstSurveyAnswered, 1);
                    // }elseif($s->survey_id == 2 && $s->answered){
                    }elseif($s->answered){
                        array_push($secondSurveyAnswered, 1);
                    }
                }
            }

            // return $secondSurveyAnswered;
        
            $answered = [
                // (object) array('name' => 'Guia de referencia I','title' => 'CUESTIONARIO PARA IDENTIFICAR A LOS TRABAJADORES QUE FUERON SUJETOS A ACONTECIMIENTOS TRAUMÁTICOS SEVEROS', 'answered' => count($firstSurveyAnswered)),
                (object) array('name' => 'Primera encuesta','title' => '1. CUESTIONARIO PARA IDENTIFICAR A LOS TRABAJADORES QUE FUERON SUJETOS A ACONTECIMIENTOS TRAUMÁTICOS SEVEROS', 'answered' => count($firstSurveyAnswered)),
                // (object) array('name' => 'Guia de referencia ' . $admin->company->type,'title' => $admin->company->type==2 ? 'IDENTIFICACIÓN Y ANÁLISIS DE LOS FACTORES DE RIESGO PSICOSOCIAL': 'IDENTIFICACIÓN Y ANÁLISIS DE LOS FACTORES DE RIESGO PSICOSOCIAL Y EVALUACIÓN DELENTORNO ORGANIZACIONAL EN LOS CENTROS DE TRABAJO', 'answered' => count($secondSurveyAnswered))
                (object) array('name' => 'Segunda encuesta','title' => $company->type==2 ? '2. IDENTIFICACIÓN Y ANÁLISIS DE LOS FACTORES DE RIESGO PSICOSOCIAL': '3. IDENTIFICACIÓN Y ANÁLISIS DE LOS FACTORES DE RIESGO PSICOSOCIAL Y EVALUACIÓN DELENTORNO ORGANIZACIONAL EN LOS CENTROS DE TRABAJO', 'answered' => count($secondSurveyAnswered))
            ];
            $usersCount = count($users);

            // return $usersCount;
            
            // return $answered;
            // return $usersCount;
            
            $company = Company::find($companyid);
    
    
            return view('Admin.empresa.index', compact('answered','usersCount', 'company', 'flag'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return 'legacy last system';
        $admin = Auth::guard('admin')->user();
        // $admin->name = 'LERO LERO';
        // $admin->save();

        // return 'cc';
        $adminid = $admin->id;
        $data = $request->all();

        $company = new Company;

        $company->name = $data['name'];
        $company->type = $data['companytype'];
        $company->access = 1;
        $company->password = Hash::make($data['password']);
        $company->save();
        // return $company;

        $admin->company_id = $company->id;
        $admin->save();

        // $admin = Admin::find();

        return redirect()->route('empresa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
