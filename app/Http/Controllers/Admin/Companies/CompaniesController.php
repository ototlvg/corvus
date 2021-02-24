<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Company;

use Illuminate\Support\Facades\Hash;


class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->middleware('admin.verified');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('Admin.empresas.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $name = $request->post('name');
        $email = $request->post('email');
        $password= $request->post('password');
        $type= $request->post('type');
        
        // return $type;
        
        $company = new Company;
        $company->name = $name;
        $company->email = $email;
        $company->password = Hash::make($password);
        $company->type = $type;
        $company->save();

        
        return redirect()->route('admin.empresas.index');
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
