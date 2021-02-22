<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\Result;
use App\ResultTrauma;
use App\Category;

class FirstSurveyController extends Controller
{
    public function index($id){
        $company = Auth::guard('company')->user();
        $companyid = $company->id;

        $valoracionClinica = '0';

        $user = User::where('company_id', $companyid)->find($id);

        $categories = Category::whereHas('preguntas', function ($query) {
            $query->where('survey_id',1);
        })->with('preguntas')->get();
        // })->get();

        
        $results = ResultTrauma::where('user_id', $user->id)->orderBy('question_id', 'ASC')->get();
        
        if(count($results) == 6){
            $categories = [$categories[0]];
            // return 'A todas';
        }
        
        // return $categories;
        // return $results;

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
            return view('Admin.atrausev', compact('categories', 'valoracionClinica', 'user', 'why'));
        }

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

        // return $categories;
        $valoracionClinica = $valoracionClinica==1 ? 'Si' : 'No';
        return view('Admin.atrausev', compact('categories', 'valoracionClinica', 'user', 'why'));
    }
}
