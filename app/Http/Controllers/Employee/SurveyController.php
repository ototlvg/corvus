<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Survey;
use App\Question;
use App\Category;
use App\CustomClass\FirstSurveySection;

class SurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAccess');
        $this->middleware('checkClientsBossQuestions');
    }

    public function index($survey){
        if($survey > 3 || $survey<1 || !is_numeric($survey)){
            // return 'Error';
            return redirect()->route('home');
        }
        return $survey;
    }

    public function first(){
        $questions = Question::orderBy('item', 'ASC')->where('survey_id',1)->get();
        $categories = Category::whereHas('questions', function($query){
            $query->where('survey_id',1);
        })->get();
        // return sizeof($questions);
        // return $questions;
        $sections = [];
        $i = 0;
        foreach($categories as $category){
            $obj = (object) ['category' => null, 'questions' => []];
            if($i == 0){
                $obj->section = '¿Ha presenciado o sufrido alguna vez, durante o con motivo del trabajo un acontecimientocomo los siguientes?:';
            }
            // $obj = new FirstSurveySection;
            // return $category;
            $obj->category = $category->category;
            // return $questions[$i]->category_id;
            while($questions[$i]->category_id == $category->id){
                array_push($obj->questions, $questions[$i]);
                $i++;
                if($i==20){
                    break;
                }
                // return $questions[$i];
            }
            array_push($sections, $obj);
            // return $sections;
            // return $category;
        }
        
        
        // return $categories;
        // $obj = new FirstSurveySection;
        
        // return response()->json($obj, 201);
        
        // return $sections;
        return view('Employee.Survey', compact('sections'));
    }

    public function second(){
        $questions = Question::orderBy('item', 'ASC')->where('survey_id',2)->get();
        return $questions;
    }

    public function store(){
        return 'HGo';
    }
}
