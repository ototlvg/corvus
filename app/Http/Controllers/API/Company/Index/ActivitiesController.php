<?php

namespace App\Http\Controllers\API\Company\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;

use App\Activity;
use App\Company;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::guard('company')->user();
        $companyid = $company->id;
        return Activity::where('company_id',$companyid)->get();
        
        return response()->json(['name' => 'Abigail','state' => 'CA',]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $companyid = Auth::guard('company')->id();
        // return $companyid;
        $company = Company::find($companyid);

        $newactivity = $request->post('activity');

        $activity = new Activity;
        $activity->company_id = $companyid;
        $activity->activity = $newactivity;
        $activity->save();


        return $activity;
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
        $companyid = Auth::guard('company')->id();
        $res = Activity::where('id',$id)->where('company_id', $companyid)->delete();

        return $res;
        return 'primesss';
    }
}
