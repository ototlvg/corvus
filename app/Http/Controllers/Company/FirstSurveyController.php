<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\Result;
use App\ResultTrauma;
use App\Category;

use PDF;

class FirstSurveyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:company');
        $this->middleware('CheckIfCompanyCanSeeResult');
        $this->middleware('PaymentDone');
        $this->middleware('ReturnAuthVariable');
    }

    public function firstSurvey($user){

        $company = Auth::guard('company')->user();
        $companyid = $company->id;

        $valoracionClinica = '0';

        // $user = User::where('company_id', $companyid)->find($id);


        $objectReturn = (object) ['redirect' => '', 'view' => null, 'categories'=> null, 'valoracionClinica' => null, 'user' => null, 'why' => null, 'only6' => false, 'resultsOnly6' => null];
        
        $valoracionClinica = '0';
        $categories = Category::whereHas('preguntas', function ($query) {
            $query->where('survey_id',1);
        })->with('preguntas')->get();
        // })->get();

        
        $results = ResultTrauma::where('user_id', $user->id)->orderBy('question_id', 'ASC')->get();
        
        // return count($results)==0 ? 'No hay nada' :  'Si hay algo';

        // $results = [];
        if(count($results) == 0 ){
            $objectReturn->redirect = 'user.resultados.index';
            // return $objectReturn;
            // return redirect()->route('user.resultados.index');
        }

        if(count($results) == 6){
            $objectReturn->view = 'Employee.results.firstSurvey';
            $categories = [$categories[0]];
            $objectReturn->only6 = true;
            $objectReturn->categories = $categories;
            $objectReturn->resultsOnly6 = $results;
            $objectReturn->why = 'Respondio NO a todas las preguntas de la primera seccion ';
            $objectReturn->user = $user;
            $objectReturn->valoracionClinica = 'No';

            // return $categories;

            foreach ($categories[0]->preguntas as $pregunta) {
                $pregunta->answer = 0;
            }

            return $objectReturn;
        }

        $answersByCategories = [];
        foreach ($categories as $category) {
                
            $answers = [];
            foreach ($category['preguntas'] as $question) {
                $answer = $results[$question->item-1]->answer;
                $question->answer = $answer;

                array_push($answers, $answer);
                // return $results[$question->item-1]->answer;
            }

            $category->answers = $answers;
            if(!($category['id']==1)){
                array_push($answersByCategories, $answers);
            }
        }

        if(count($results) == 6){
            // return 'Solo hay 6 resultados, por lo que contesto a todas no';
            // return $categories;
            $why = 0;
            $valoracionClinica = $valoracionClinica==1 ? 'Si' : 'No';
            // $view = 'Admin.atrausev';
            // return view($view, compact('categories', 'valoracionClinica', 'user', 'why'));
        }else{
            //---------------------------------------------------------------
            // $answersByCategories[0] - Sección II Recuerdos persistentes sobre acontecimiento
            // $answersByCategories[1] - Sección III Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento
            // $answersByCategories[2] - Sección IV Afectación
    
            if(in_array(1, $answersByCategories[0])){
                $valoracionClinica = 1;
                $why = 'Cuando responda "Sí", en alguna de las preguntas de la Sección II Recuerdos persistentes sobre acontecimiento';
                // return 'Existe un uno enn la seguna';
            }else{
                $amounts = [3,2];
                $flag = 0;
                for ($i=1; $i <=2 ; $i++) { 
                    $categoryAnswers = $answersByCategories[$i];
    
                    $trueAnswers = array_filter($categoryAnswers,function($answer){
                        return $answer==1;
                    });
    
                    // return count($trueAnswers);
    
                    $flag = $i;
                    if(count($trueAnswers) >= $amounts[$i-1]){
                        $valoracionClinica = 1;
    
                        $i = 1000;
                    }
    
                }
    
                if($flag==1){
                    $why = 'Cuando responda "Sí", en tres o más de las preguntas de la Sección III Esfuerzo por evitar circunstancias parecidas o asociadas al acontecimiento';
                }else{
                    $why = 'Cuando responda "Sí", en dos o más de las preguntas de la Sección IV Afectación';
                }
    
    
            }
            $valoracionClinica = $valoracionClinica==1 ? 'Si' : 'No';
            $view = 'Employee.results.firstSurvey';
            // return view('Employee.results.firstSurvey', compact('categories', 'valoracionClinica', 'user', 'why'));
        }

        $objectReturn->view = 'Employee.results.firstSurvey';
        $objectReturn->categories = $categories;
        $objectReturn->valoracionClinica = $valoracionClinica;
        $objectReturn->user = $user;
        $objectReturn->why = $why;
        
        // return 'xls';
        return $objectReturn;

    }

    public function index($id){
        $company = Auth::guard('company')->user();
        $companyid = $company->id;

        $user = User::where('company_id', $companyid)->with('profile')->find($id);

        $obj = $this->firstSurvey($user);

        if(!empty($obj->redirect)){
            return 'Sin informacion';
            return redirect()->route('user.resultados.index');
            return 'reedireccionad';
        }else{

            $view = $obj->view;
            $categories = $obj->categories;
            $valoracionClinica = $obj->valoracionClinica;
            $user = $obj->user;
            $why = $obj->why;
            
            // return 'entrando en else';
            // return $why;
            // return view('Company.atrausev', compact('categories', 'valoracionClinica', 'user', 'why'));
            return view('Company.atrausev', compact('categories', 'valoracionClinica', 'user', 'why', 'company'));
        }

    }
    
    public function download($userid){
        $company = Auth::guard('company')->user();
        $companyid = $company->id;

        $user = User::where('company_id', $companyid)->with('profile')->find($userid);

        // return $user;

        $obj = $this->firstSurvey($user);

        $view = $obj->view;
        $categories = $obj->categories;
        $valoracionClinica = $obj->valoracionClinica;
        $why = $obj->why;
        $only6 = $obj->only6;

        $pdf = PDF::loadView('Employee.download.firstSurvey', [
            'categories' => $categories,
            'valoracionClinica' => $valoracionClinica,
            'why' => $why,
            'user' => $user,
            'company' => $company,
            'only6' => $only6
        ]);
        
        $pdf->setOption('page-size','letter');
        $pdf->setOption('orientation','portrait');
        // $pdf->setOption('orientation','landscape');
        $pdf->setOption('margin-left',20);
        $pdf->setOption('margin-right',20);
        $pdf->setOption('margin-top',20);
        $pdf->setOption('margin-bottom',20);

        return $pdf->stream('invoice.pdf');
    }
}
