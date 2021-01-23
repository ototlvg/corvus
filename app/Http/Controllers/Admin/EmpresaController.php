<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\Company;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $companyid = $admin->company_id;

        // $users = User::where('company_id',$companyid)->with('status.survey')->get();
        $users = User::where('company_id',$companyid)->with('status')->get();
        


        // $completed = [ [], [] ];
        
        $firstSurveyAnswered = [];
        $secondSurveyAnswered = [];
        for ($i=0; $i < count($users); $i++) { 
            $user = $users[$i];

            foreach ($user->status as $key => $s) {
                if($s->survey_id == 1 && $s->answered){
                    array_push($firstSurveyAnswered, 1);
                }elseif($s->survey_id == 2 && $s->answered){
                    array_push($secondSurveyAnswered, 1);
                }
            }
        }

        // return $secondSurveyAnswered;
        $answered = [
            (object) array('name' => 'Guia de referencia I','title' => 'CUESTIONARIO PARA IDENTIFICAR A LOS TRABAJADORES QUE FUERON SUJETOS A ACONTECIMIENTOS TRAUMÁTICOS SEVEROS', 'answered' => count($firstSurveyAnswered)),
            (object) array('name' => 'Guia de referencia ' . $companyid,'title' => $companyid==2 ? 'IDENTIFICACIÓN Y ANÁLISIS DE LOS FACTORES DE RIESGO PSICOSOCIAL': 'IDENTIFICACIÓN Y ANÁLISIS DE LOS FACTORES DE RIESGO PSICOSOCIAL Y EVALUACIÓN DELENTORNO ORGANIZACIONAL EN LOS CENTROS DE TRABAJO', 'answered' => count($secondSurveyAnswered))
        ];
        $usersCount = count($users);
        
        // return $answered;
        // return $usersCount;
        
        $company = Company::find($companyid);


        return view('Admin.empresa.index', compact('answered','usersCount', 'company'));
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
        //
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
