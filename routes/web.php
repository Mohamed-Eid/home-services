<?php
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

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
    return redirect('dashboard/index');
    //return 
});

Route::post('/test-upload', function () {
    dd(request()->all());
})->name('test-upload');


// Route::get('/clear-cache', function() {
//     Artisan::call('cache:clear');
//     Artisan::call('view:clear');
//     Artisan::call('view:clear');

//     return "Cache is cleared";
// });

// Route::get('/edit_orders', function () {
//     $clients = \App\Client::all();
//     foreach($clients as $client)
//     {
//         if($client->district_id == null){
//             $client->district_id = 29;
//             $client->save();
//         } 
//     }
//     dd('done');
// });
Route::get('mails',function(){
    $super_admin = \App\User::whereHas('roles', function($q)
            {
                $q->where('name', 'super_admin');
            })->first();
    dd($admins);

});

// Route::get('/time',function(){
//     $mytime = Carbon\Carbon::now();
//     dd($mytime->toDateTimeString());
// });

Auth::routes(['register' => false]);

Route::get('/home/', function(){
    return redirect()->route('dashboard.index');
})->name('home');

Route::get('/migrate', function () {
	
	/* php artisan migrate */
    \Artisan::call('migrate');
    dd("Done");
});



Route::get('/test', function () {

    return DB::table('orders')
    ->join('clients','orders.client_id','clients.id')
    ->join('districts','clients.district_id','districts.id')
    ->select('orders.*')
    ->where('city_id',1)
    ->get();

    

    return DB::table('orders')->where('client');

});




Route::get('/updateapp', function()
{
    
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');

    dd("Done");
    // exec('composer dump-autoload');
    // echo 'composer dump-autoload complete';
});

Route::get('/notify', function () {

        $sourceKey = env('FIREBASE_FCM_KEY');
        $header = [
            'Authorization'=> 'key=' . $sourceKey,
            'Content-Type' => 'application/json'
        ];
        $body = [
            'data'=> [
                'title' => request()->title,
                'body'  => request()->body,
                'content_available' => true,

                //'image' => $data->image,
                'sound' => 'default'
            ] , 
            'notification' => [
                'title' => request()->title,
                'body'  => request()->body,
                'content_available' => true,

                //'image' => $data->image,
                'sound' => 'default'
            ],
            'content_available' => true,
            'to' => 'fdXZTaqDIEH3tDUSvBdS62:APA91bEG3a7ZyRWRVqBaNl2VnbLEVf5x9-U5j5T7HK6C0PoHOtEKTB_nLDOCTf7LT2bIYYINQgL-uy9NE0yKA7z0CqIZOe2MLMs9egTcb4PWcCrTxF5hd29Zmje9L5W7gNmBVIAbg2aF',
        ];

        $client = new Client(['headers' => $header]);
        
        $res = $client->post('https://fcm.googleapis.com/fcm/send',[
            'body' => json_encode($body),
        ]);

        dd(json_decode($res->getBody()));
});