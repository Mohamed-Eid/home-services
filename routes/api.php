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
            Route::get('test','ClientController@get_client');


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
                Route::post('register','MemberController@register_member');
                Route::post('login','MemberController@login');
                Route::post('update_fcm_token','MemberController@update_fcm_token')->middleware('authorizemember');;
                Route::get('profile','MemberController@profile')->middleware('authorizemember');
                Route::post('update_profile','MemberController@update_profile')->middleware('authorizemember');;
                Route::post('change_password','MemberController@change_password')->middleware('authorizemember');;
            });


            Route::group(['prefix' => 'rate'], function () {
                Route::post('' , 'RateController@rate')->middleware('authorizeclient');
            });

            Route::get('banks' , 'BankController@index');

            Route::get('categories' , 'CategoryController@index')->name('cats');
            Route::get('categories/{category}' , 'CategoryController@products');
            Route::get('categories/{category}/vendors' , 'CategoryController@vendors')->name('vendors_by_cat');
            
            Route::get('v2/categories/' , 'CategoryController@categories');
            Route::get('v2/categories/{category}' , 'CategoryController@products');



            Route::group(['prefix' => 'cities'], function () {
                Route::get('','CityController@all_cities');
                Route::get('/{city}','CityController@get_districts_by_city_id');
            });

            Route::get('about','AboutController@index');
            Route::get('terms','TermController@index');
            
            
            Route::group(['prefix' => 'client', 'middleware' => ['authorizeclient']], function () {
                Route::put('update_fcm_token' , 'ClientController@update_token');
                Route::put('update_locale' , 'ClientController@update_locale');
            });

        });//end of api routes
});