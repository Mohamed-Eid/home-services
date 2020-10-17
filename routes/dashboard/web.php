<?php


Route::group(
    ['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],
    function(){
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){

            Route::get('/index','DashboardController@index')->name('index');

            //user routes
            Route::resource('users' , 'UserController');
            Route::resource('/categories','CategoryController');

            Route::resource('/plans','PlanController');


            Route::resource('/clients','ClientController');
           
           
            Route::resource('/times','DeliveryTimeController');
            
            Route::resource('/banks','BankController');
            




            Route::prefix('coupons')->name('coupons.')->group(function(){
                Route::get('','CouponController@index')->name('index');
                Route::post('/add_coupons','CouponController@add_coupons')->name('add_coupons');
                Route::get('/edit_coupons/{coupon}','CouponController@edit_coupons')->name('edit_coupons');
                Route::put('/edit_coupons/{coupon}/update','CouponController@update_coupons')->name('update_coupons');
                Route::delete('/delete_coupons/{coupon}','CouponController@delete_coupons')->name('delete_coupons');

            });

            Route::resource('countries','CountryController');
            //Route::resource('products.details.custom_details','Product\DetailController');
            Route::resource('products.details.subdetails','Product\Detail\SubdetailController');
            Route::resource('countries.cities','Country\CityController');
            
            Route::get('about','AboutController@about_us')->name('abouts');
            Route::put('about','AboutController@update')->name('abouts.update');

            Route::get('tax','TaxController@index')->name('tax');
            Route::put('tax','TaxController@update')->name('tax.update');

            Route::get('service_number','ServiceNumberController@service_number')->name('service_number');
            Route::put('service_number','ServiceNumberController@update')->name('service_number.update');
            
            Route::get('terms','TermController@index')->name('terms');
            Route::put('terms','TermController@update')->name('terms.update');
            
            Route::get('download','DownloadController@index')->name('download');
            Route::put('download','DownloadController@update')->name('download.update');
            

            Route::get('details','DetailController@index')->name('details');
            Route::post('details','DetailController@store')->name('details.store');
            
            Route::get('profile','ProfileController@edit')->name('profiles.edit');
            Route::put('profile','ProfileController@update')->name('profiles.update');
            
            Route::get('profile/change_password','ProfileController@change_password')->name('profiles.change_password');
            Route::put('profile/change_password','ProfileController@change_password_method')->name('profiles.change_password_method');



            //members
            Route::get('members','MemberController@index')->name('members.index');
            Route::get('members/{client}','MemberController@show')->name('members.show');
            Route::get('members/{client}/edit','MemberController@edit')->name('members.edit');
            Route::put('members/{client}/update','MemberController@update')->name('members.update');
            Route::put('members/{client}/update_password','MemberController@update_password')->name('members.update_password');
            Route::delete('members/{client}','MemberController@delete')->name('members.delete');


            Route::get('agents','AgentsController@index')->name('agents.index');
            Route::get('agents/{agent}','AgentsController@show')->name('agents.show');
            Route::get('agents/{agent}/edit','AgentsController@edit')->name('agents.edit');
            Route::put('agents/{agent}/update','AgentsController@update')->name('agents.update');
            Route::delete('agents/{agent}','AgentsController@delete')->name('agents.delete');


            //slider
            Route::get('slider','SliderController@index')->name('slider.index');
            Route::post('slider','SliderController@upload_images')->name('slider.upload_images');
            Route::delete('slider/{slider}','SliderController@destroy')->name('slider.delete');

        });//end of dashboard routes
});

