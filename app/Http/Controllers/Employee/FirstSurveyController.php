<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Survey;
use App\Question;
use App\Category;
use App\User;
use App\Status;
use App\Result;
use App\ResultTrauma;

class FirstSurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAccess');
        $this->middleware('checkClientsBossQuestions');
    }

    public function index(){
        $userid = Auth::user()->id;
        // $questions = Question::orderBy('item', 'ASC')->where('survey_id',1)->get();
        $categories = Category::whereHas('questions', function($query){
            $query->where('survey_id',1);
        })->get();
        // })->get()->toArray();

        // return $categories;

        $user = User::find($userid);

        $status = Status::where('user_id', $userid)->where('survey_id', 1)->first();

        if($status->answered == 1){
            return 'Encuesta ya contestada';
        }

        // return $user->iteration;
        $first_section_results = ResultTrauma::where('user_id',$userid)->where('iteration', $user->iteration)->get();
        // return $first_section_results;
        // return $first_section_results->isEmpty() ? 'No existen resultados' : 'Si existen resultados';


        $sections = [];
        if($first_section_results->isEmpty()){
            $questions = Question::orderBy('item', 'ASC')->where('survey_id',1)->where('category_id',1)->get();
            $obj = (object) ['category' => null, 'questions' => []];
            $obj->category = $categories[0]->category;
            $obj->questions = $questions;
            array_push($sections, $obj);
            // $surveyRouteName = 'survey.store.first';
            // return 'hola';
            // return $questions;
            // return 'Preguntas de primera encuesta';
        }else{
            $questions = Question::orderBy('item', 'ASC')->where('survey_id',1)->where('category_id', '!=', 1)->get();
            // $sections = [];
            $i = 0;
            foreach($categories as $category){
                // return gettype($x);
                // return 'ol';
                $obj = (object) ['category' => null, 'questions' => []];
                // if($i == 0){
                //     $obj->section = '¿Ha presenciado o sufrido alguna vez, durante o con motivo del trabajo un acontecimientocomo los siguientes?:';
                // }
                // $obj = new FirstSurveySection;
                // return $category;
                $obj->category = $category->category;
                // return $questions[$i]->category_id;
                while($questions[$i]->category_id == $category->id){
                    array_push($obj->questions, $questions[$i]);
                    $i++;
                    if($i==14){
                        break;
                    }
                    // return $questions[$i];
                }
                if($category->id != 1){
                    array_push($sections, $obj);
                }
            }

        }
        
        
        $surveyRouteName = 'survey.store.first';
        // return $sections;
        return view('Employee.Survey', compact('sections', 'surveyRouteName'));
    }
    
    public function store(Request $request){
        $userid= Auth::user()->id;
        $user = User::find($userid);
        // return $user;

        $first_section_results = ResultTrauma::where('user_id',$userid)->where('iteration', $user->iteration)->get();

        // return $first_section_results->isEmpty();

        if($first_section_results->isEmpty()){
            for($i=1; $i<=6; $i++){
                $r = new ResultTrauma;
                $r->question_id = $i;
                $r->answer = $request->post($i);
                $r->user_id = $userid;
                $r->iteration = $user->iteration;
                $r->save();
            }

            return redirect()->route('survey.first');
        }else{
            // return 'Guardara de la segunda';
            // return $request->post();
            for ($i=7; $i <= 20; $i++) { 
                $r = new ResultTrauma;
                $r->question_id = $i;
                $r->answer = $request->post($i);
                $r->user_id = $userid;
                $r->iteration = $user->iteration;
                $r->save();
            }
            $status = Status::where('survey_id',1)->where('user_id', $userid)->first();
            $status->answered = 1;
            $status->save();

            return redirect()->route('home');
        }
    }
}
