<?php

namespace App\Http\Controllers\API\Company\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Stripe\Stripe as Stripe;
use Illuminate\Support\Facades\Auth;

class CheckoutSessionController extends Controller
{

    public function create(){
        // return response()->json(Auth::guard('company')->user());
        // $company = Auth::guard('company')->user();
        Stripe::setApiKey('sk_test_51IOcIuCSm0hMqsgEMls3pEB7N550e5aTH5dbbryFE3yAZe7lZYJSU6t6MRyPlhT69yisIPBq9C4dpLBoz4PBNLH600pKJt5ETn');

        header('Content-Type: application/json');
        
        $YOUR_DOMAIN = 'http://corvus.com';
        
        $checkout_session = \Stripe\Checkout\Session::create([
          'payment_method_types' => ['card'],
          'line_items' => [[
            'price_data' => [
              'currency' => 'mxn',
              'unit_amount' => 1100*100,
              'product_data' => [
                'name' => 'Stubborn Attachments',
                'images' => ["https://i.imgur.com/EHyR2nP.png"],
              ],
            ],
            'quantity' => 1,
          ]],
          'mode' => 'payment',
          'success_url' => $YOUR_DOMAIN . "/success.php?session_id={CHECKOUT_SESSION_ID}",
          'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
          'client_reference_id' => Auth::guard('company')->user()->name
        ]);
        
        
        
        echo json_encode(['id' => $checkout_session->id]);
        // response()->json(['id' => $checkout_session->id]);
    }
}
