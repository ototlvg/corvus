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

class SecondSurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAccess');
        $this->middleware('checkClientsBossQuestions');
    }

    public function index(){
        $userid = Auth::user()->id;

        $user= User::find($userid)->with('profile')->first();
        // return $user->profile->clients;

        $boss = $user->profile->boss;
        $clients = $user->profile->clients;

        // $companytypeid =  User::find($userid)->company_type->type;
        $companytypeid =  $user->company_type->type;


        // return $companyid;
        $categories = Category::whereHas('questions', function($query) use($companytypeid){
            $query->where('survey_id',$companytypeid);
        })->get();

        // return $categories;


        $user = User::find($userid);

        $sections = [];
        // if($first_section_results->isEmpty()){
        if(false){
            $questions = Question::orderBy('item', 'ASC')->where('survey_id',1)->where('category_id',1)->get();
            $obj = (object) ['category' => null, 'questions' => []];
            $obj->category = $categories[0]->category;
            $obj->questions = $questions;
            array_push($sections, $obj);
        }else{
            $questions = Question::orderBy('item', 'ASC')->where('survey_id',$companytypeid)->where('category_id', '!=', 1)->get()->toArray();
            // return gettype($questions[0]);
            // return $questions[0]['category_id'];
            // return $questions;
            // $sections = [];
            foreach($categories as $category){
                $obj = (object) ['category' => null, 'questions' => []];
                $obj->category = $category->category;
                $obj->questions = [];

                $categoryid = $category->id;

                $questionsOfSection = array_filter($questions, function($question) use($categoryid){
                    return $question['category_id']==$categoryid;
                });
                // $obj->questions = (array) $questionsOfSection;
                // return gettype($obj->questions);

                // No lo guarde directamente porque por algunna razon el navegador lo estaba conviertiendo el array en obj
                foreach($questionsOfSection as $question){
                    array_push($obj->questions, (object) $question);
                }
                array_push($sections, $obj);
                
            }
                        
        }
        // return $sections;
        
        $surveyRouteName = 'survey.store.first';
        return view('Employee.Survey', compact('sections', 'surveyRouteName'));
    }
}
