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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::group(
    ['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function(){
        Route::prefix('api')->name('api.')->middleware(['api'])->group(function(){

            Route::group(['prefix' => 'clients'], function () {
                Route::post('register','ClientController@register_client');
                Route::post('activate/{client}','ClientController@activate_client');
                Route::post('login','ClientController@login');
                Route::get('profile','ClientController@profile')->middleware('authorizeclient');
                Route::get('notifications','ClientController@notifications')->middleware('authorizeclient');;
                Route::post('update_profile','ClientController@update_profile')->middleware('authorizeclient');;
                Route::post('update_fcm_token','ClientController@update_fcm_token')->middleware('authorizeclient');;
                Route::post('change_password','ClientController@change_password')->middleware('authorizeclient');;
                Route::post('forget_password','ClientController@forget_password');
                Route::post('check_forget_code','ClientController@check_forget_code');
                Route::post('renew_password','ClientController@renew_password');
            });


            Route::group(['prefix' => 'agents'], function () {
                Route::post('register','AgentController@register');
                Route::post('login','AgentController@login');
                Route::post('update_fcm_token','AgentController@update_fcm_token')->middleware('authorizemember');;
                Route::get('profile','AgentController@profile')->middleware('authorizemember');
                Route::post('update_profile','AgentController@update_profile')->middleware('authorizemember');;
                Route::post('change_password','AgentController@change_password')->middleware('authorizemember');;
            });

 

            Route::group(['prefix' => 'rate'], function () {
                Route::post('' , 'RateController@rate')->middleware('authorizeclient');
            });

            Route::get('banks' , 'BankController@index');
            Route::get('plans' , 'PlanController@index');

            Route::get('categories' , 'CategoryController@index')->name('cats');
            Route::get('categories/{category}' , 'CategoryController@products');
            Route::get('categories/{category}/vendors' , 'CategoryController@vendors')->name('vendors_by_cat');
            
            Route::get('categories/{category}/services' , 'ServiceController@get_services_by_category');

            Route::get('jobs/{job}/services' , 'ServiceController@get_services_by_job');


            Route::group(['prefix' => 'countries'], function () {
                Route::get('','CountryController@index');
                Route::get('/{country}/cities','CountryController@cities');
            });

            Route::get('about','AboutController@index');
            Route::get('terms','TermController@index');
            
            
            Route::group(['prefix' => 'client', 'middleware' => ['authorizeclient']], function () {
                Route::put('update_fcm_token' , 'ClientController@update_token');
                Route::put('update_locale' , 'ClientController@update_locale');
            });

        });//end of api routes
});