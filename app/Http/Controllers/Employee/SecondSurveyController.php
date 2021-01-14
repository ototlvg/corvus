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
// use App\ResultTrauma;

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
        // return $user;
        $clients = $user->profile->clients;

        // $companytypeid =  User::find($userid)->company_type->type;
        $companytype =  $user->company_type->type;


        // return $companyid;
        $categories = Category::whereHas('questions', function($query) use($companytype){
            $query->where('survey_id',$companytype);
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
            $questions = Question::orderBy('item', 'ASC')->where('survey_id',$companytype)->where('category_id', '!=', 1)->get()->toArray();
            // return gettype($questions[0]);
            // return $questions[0]['category_id'];
            // return $questions;
            // $sections = [];
            foreach($categories as $category){
                $obj = (object) ['category' => null, 'questions' => []];
                $obj->category = $category->category;
                $obj->questions = [];

                $categoryid = $category->id;
                // return $boss==1 ? 'coco' : 'caca';
                if($boss && $clients){
                    $questionsOfSection = array_filter($questions, function($question) use($categoryid){
                        return $question['category_id']==$categoryid;
                    });
                }else{
                    $questionsForClients = $companytype == 2 ? [41,42,43] : [65,66,67,68];
                    $questionsForBoss = $companytype == 2 ? [44,45,46] : [69,70,71,72];
                    if(!$boss && !$clients){
                        $dontAdd = array_merge($questionsForClients,$questionsForBoss);
                        // return $dontAdd;
                        $questionsOfSection = array_filter($questions, function($question) use($categoryid, $dontAdd){
                            return $question['category_id']==$categoryid && !in_array((int)$question['item'], $dontAdd);
                        });
                    }else{
                        if($boss){
                            $dontAdd = $questionsForClients;
                            $questionsOfSection = array_filter($questions, function($question) use($categoryid, $dontAdd){
                                return $question['category_id']==$categoryid && !in_array((int)$question['item'], $dontAdd);
                            });
                        }else{
                            $dontAdd = $questionsForBoss;
                            $questionsOfSection = array_filter($questions, function($question) use($categoryid, $dontAdd){
                                return $question['category_id']==$categoryid && !in_array((int)$question['item'], $dontAdd);
                            });
                        }
                    }
                }

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
        
        $surveyRouteName = 'survey.store.second';
        return view('Employee.SurveySecond', compact('sections', 'surveyRouteName'));
    }

    public function store(Request $request){
        $userid= Auth::user()->id;
        $user = User::find($userid);

        $companytype =  $user->company_type->type;

        $allNamesInputs = array_keys($request->all());

        array_shift($allNamesInputs);

        // return $allNamesInputs; 
        // return $request->all();  

        // return $request->post(22);
        foreach ($allNamesInputs as $inputname) {
            $r = new Result;
            $r->survey_id = $companytype;
            $r->question_id = (int) $inputname;
            // return $request->post($inputname);
            $r->answer_id = $request->post((int) $inputname);
            $r->user_id = $userid;
            $r->iteration = $user->iteration;
            $r->save();
        }

        $status = Status::where('survey_id',$companytype)->where('user_id', $userid)->first();
        $status->answered = 1;
        $status->save();

        return redirect()->route('home');
    }
}
