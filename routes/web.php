<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::resources([
//     'cuestionario/resultados' => Employee\ResultsController::class,
// ]);

Route::resource('cuestionario/resultados', 'Employee\ResultsController', [
    'as' => 'user',
]);

// MW para verificar si el empleado ya contesto las dos preguntas ded que si es jefe y atiende clientes
Route::get('/home/fq/{type}', 'Employee\InitialQuestionsController@index')->name('initialQuestion');
Route::post('/home/fq', 'Employee\InitialQuestionsController@store')->name('initialQuestionStore');


// Cuestionarios
// Route::get('cuestionario/{survey}', 'Employee\SurveyController@index')->name('survey.index');
Route::get('cuestionario/atrausev', 'Employee\FirstSurveyController@index')->name('survey.first');
Route::get('cuestionario/rpsic', 'Employee\SecondSurveyController@index')->name('survey.second');

Route::post('cuestionario/atrausev', 'Employee\FirstSurveyController@store')->name('survey.store.first');
Route::post('cuestionario/rpsic', 'Employee\SecondSurveyController@store')->name('survey.store.second');
//
Route::get('tests', 'TestsController@index');

//
Route::get('/admin', function () {
    return redirect()->route('admin.empresas.index');
});

Route::get('/company', function () {
    return redirect()->route('empresa.index');
});


Route::get('cuestionario/descargar/{surveytype}', 'Employee\ResultsController@download')->name('employee.download');


// Logout infividual de user
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');


Route::group(['prefix' => 'admin'], function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Route::get('/home', 'Admin\HomeController@index')->name('admin.home');

    Route::resource('/empresas', 'Admin\Companies\CompaniesController', [
        'as' => 'admin',
    ]);

    // No descomentar
    // Password resets routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});


Route::group(['prefix' => 'empresa'], function(){
    Route::get('/login', 'Auth\CompanyLoginController@showLoginForm')->name('company.login');
    Route::post('/login', 'Auth\CompanyLoginController@login')->name('company.login.submit');
    Route::get('/logout', 'Auth\CompanyLoginController@logout')->name('company.logout');
    
    Route::get('/registro', 'Auth\CompanyRegisterController@show')->name('company.register.show');
    Route::get('/validar/{email}', 'Auth\CompanyRegisterController@validateEmail')->name('company.register.validateEmail');
    Route::get('/confirmar', 'Auth\CompanyRegisterController@confirmation')->middleware('auth:company')->name('company.register.confirmation');
    Route::post('/registro', 'Auth\CompanyRegisterController@register')->name('company.register.register');
    // Route::post('/registro', 'Auth\CompanyRegisterController@register')->name('company.register.register');
    
    Route::get('/pago', 'Company\PaymentController@index')->name('company.payment.index');
    Route::get('/pago/exitoso', 'Company\PaymentController@success')->name('company.payment.success');
    
    
    Route::resources([
        'users' => Company\UsersController::class,
    ]);

    Route::post('/users/uploadfromexcel', 'Company\UsersController@importFromExcel')->name('empresa.users.excel');
        
    Route::resources([
        'empresa' => Company\EmpresaController::class,
    ]);



    // Route::resource('/', 'Company\CompanyController', [
    //     'as' => 'empresa',
    // ]);

    Route::get('/rpsic/{user}', 'Company\SecondSurveyController@index')->name('admin.rpsic.index');
    Route::get('/rpsic/download/{user}', 'Company\SecondSurveyController@download')->name('company.rpsic.download');
    
    Route::get('/atrausev/{user}', 'Company\FirstSurveyController@index')->name('admin.atrausev.index');
    Route::get('/atrausev/download/{user}', 'Company\FirstSurveyController@download')->name('company.atrausev.download');

    // Password resets routes
    Route::post('/password/email', 'Auth\CompanyForgotPasswordController@sendResetLinkEmail')->name('company.password.email');//este es el metodo que envia el mail al correo, cual correo se enviara se definie en el Model!!!
    Route::get('/password/reset', 'Auth\CompanyForgotPasswordController@showLinkRequestForm')->name('company.password.request');
    Route::post('/password/reset', 'Auth\CompanyResetPasswordController@reset')->name('company.password.update');
    Route::get('/password/reset/{token}', 'Auth\CompanyResetPasswordController@showResetForm')->name('company.password.reset');
});

Route::post('/api/empresa/payment/create-checkout-session', 'API\Company\Payment\CheckoutSessionController@create');

Route::get('/api/empresa/getactivities', 'API\Company\Index\ActivitiesController@index');
Route::post('/api/empresa/addactivity', 'API\Company\Index\ActivitiesController@store');
Route::delete('/api/empresa/destroyactivity/{id}', 'API\Company\Index\ActivitiesController@destroy');