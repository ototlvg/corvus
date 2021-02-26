<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/payment/create-checkout-session', function (Request $request) {
//     return $request->user();
// });


// Route::get('/payment/create-checkout-session', 'API\Company\CheckoutSessionController@create')->name('company.payment.create.session');
// Route::post('/empresa/payment/create-checkout-session', 'API\Company\Payment\CheckoutSessionController@create');