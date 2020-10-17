<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function store(){
        return 'HGo';
    }
}
