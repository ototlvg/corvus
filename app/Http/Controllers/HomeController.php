<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Company;
use App\Status;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAccess');
        $this->middleware('checkClientsBossQuestions');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return Auth::user();
        // dd(auth()->user()->id);

        $userid = Auth::user()->id;
        $user = User::find($userid);
        // return $user;

        // $company = Company::first();
        $company_type = $user->company_id;

        // Status
        // $status = Status::where('user_id', Auth::user()->id)->where('answered', 0)->orderBy('survey_id', 'asc')->get();

        $ref1 = Status::where('user_id', Auth::user()->id)->where('answered', 0)->where('survey_id', 1)->with('survey')->first();
        
        if($company_type != 1){
            $ref2 = Status::where('user_id', Auth::user()->id)->where('answered', 0)->where('survey_id', $company_type)->with('survey')->first();
            // return $ref2;
        }

        $surveys = [];

        !empty($ref1) ? array_push($surveys, $ref1) : false;
        isset($ref2) ? array_push($surveys, $ref2) : false;


        // !empty($ref1) ? $first = $ref1 : $first = null;
        // isset($ref2) ? $second = $ref2 : $second = null;
        // $second = null;


        // return $surveys;

        // return $company_type;
        

        return view('Employee/home',compact('surveys'));
        // return view('Employee/home',compact('first', 'second'));
    }

    
}
