<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use \Stripe\Stripe as Stripe;

use App\Company;

class PaymentController extends Controller
{
    public function __construct(){
        $this->middleware('auth:company');
        $this->middleware('email.verified.company');
        $this->middleware('RedirectIfPaymentIsDone');
        $this->middleware('ReturnAuthVariable');
    }

    public function index(){
        // $companyGlobal = Auth::guard('company')->user();
        // return view('Company.payment.index',compact('companyGlobal'));
        return view('Company.payment.index');
    }

    public function success(){
        $company = Auth::guard('company')->user();
        // $companyid = $company->id;

        // return $companyid;

        Stripe::setApiKey('sk_test_51IOcIuCSm0hMqsgEMls3pEB7N550e5aTH5dbbryFE3yAZe7lZYJSU6t6MRyPlhT69yisIPBq9C4dpLBoz4PBNLH600pKJt5ETn');
        // // $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        // // $customer = \Stripe\Customer::retrieve($session->customer);

        $session_id = $_GET['session_id'];
        // echo 'Session id: ' . $session_id;

        $session = \Stripe\Checkout\Session::retrieve($session_id);

        // return $session;

        $object = (object) ['client_reference_id' => $session->client_reference_id, 'payment_status' =>$session->payment_status];

        if($object->payment_status){
            // $company = Company::find($companyid);
            $company->access = 1;
            $company->save();
        }
        
        return view('Company.payment.success', compact('object'));
    }
}
