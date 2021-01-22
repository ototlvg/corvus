<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Result;
use App\ResultTrauma;
use App\Category;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
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
        // return view('Admin.home');
        $admin = Auth::guard('admin')->user();
        $companyOfAdminId = $admin->company_id;
        // $users = User::where('company_id', $companyOfAdminId)->paginate(1);
        $users = User::where('company_id', $companyOfAdminId)->with('status')->paginate(1);
        // return $users;
        // dd($admin);
        // return $admin;
        // return $users;
        return view('Admin.home', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $admin = Auth::guard('admin')->user();
        $companyid = $admin->company_id;
        $user = User::where('company_id', $companyid)->find($id);

        
        // return $user;
        return view('Admin.users.show', compact('user'));
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
