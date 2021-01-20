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


// Logout infividual de user
Route::get('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');


Route::group(['prefix' => 'admin'], function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    // Route::get('/', 'Admin\HomeController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    // Route::resource('home`', 'Admin\HomeController');

    Route::resources([
        'users' => Admin\HomeController::class,
    ]);

    Route::get('/rpsic/{user}', 'Admin\SecondSurveyController@index')->name('admin.rpsic.index');

    // Password resets routes
    // Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    // Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    // Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    // Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

