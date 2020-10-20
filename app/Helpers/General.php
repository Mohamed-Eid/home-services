<?php

use App\Client;

function get_client_by_token()
{
    $token = request()->header('x-api-key');
    $client = Client::where('api_token',$token)->first();

    if($client)
    {
        return $client;
    }
    return null;
}




function upload_image($path , $image , $width=300 , $height=null)
{
    // $image must be a $request->image 
    Intervention\Image\Facades\Image::make($image)->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
    })
        ->save(public_path('uploads/'.$path .'/'. $image->hashName()));
    return $image->hashName();
}

function upload_image_base64($path , $image , $width=300 , $height=null)
{
    // $image must be a $request->image 
    $name = time().rand().'.png';
    Intervention\Image\Facades\Image::make($image)->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
    })
        ->save(public_path('uploads/'.$path .'/'. $name));
    return  $name;
}

function discount($price,$discount)
{
    return $price - $price*($discount/100);
}


function upload_image_without_resize($path , $image )
{
    // $image must be a $request->image 
    Intervention\Image\Facades\Image::make($image)->save(public_path('uploads/'.$path .'/'. $image->hashName()));
    return $image->hashName();
}

function delete_image($folder , $image)
{
    Illuminate\Support\Facades\Storage::disk('public_uploads')->delete('/'.$folder.'/' . $image);
}

function send_notification($fcm_token)
{
    $sourceKey = env('FIREBASE_FCM_KEY');
    $header = [
        'Authorization'=> 'key=' . $sourceKey,
        'Content-Type' => 'application/json'
    ];
    $body = [
        'data'=> [
            'title' => __('site.you_have_new_order'),
            'body'  => __('site.you_have_new_order'),
            'sound' => 'default',
            'content_available' => true,
            'type_id' => 3,
        ] , 
        'notification' => [
            'title' => __('site.you_have_new_order'),
            'body'  => __('site.you_have_new_order'),
            'sound' => 'default',
            'content_available' => true,
            'type_id' => 3,

        ],
        'content_available' => true,
        'to' => $fcm_token ?? NULL,
    ];
    //dd($body);
    $client = new \GuzzleHttp\Client(['headers' => $header]);
    //dd($client);
    $res = $client->post('https://fcm.googleapis.com/fcm/send',[
        'body' => json_encode($body),
    ]);
    //dd(json_decode($res->getBody()));
}


?>