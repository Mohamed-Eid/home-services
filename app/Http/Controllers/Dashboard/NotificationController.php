<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Intervention\Image\Facades\Image;
use App\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        return view('dashboard.notifications.edit');
    }

    public function send()
    {
        $users = \App\Client::all();
        $tokens = [];
        foreach($users as $user)
        {
            if($user->fcm_token != null)
                array_push($tokens,$user->fcm_token);
        }
        //dd($tokens);
        //dd($tokens);
        $sourceKey = env('FIREBASE_FCM_KEY');
        //dd($sourceKey);
        $header = [
            'Authorization'=> 'key=' . $sourceKey,
            'Content-Type' => 'application/json'
        ];
        $data = [
                'title' => request()->title,
                'body'  => request()->body,
                'content-available'=>1,
                'sound' => 'default'
            ];
        if (request()->image) {
            $image = Image::make(request()->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->save(public_path('uploads/notification_images/' . request()->image->hashName()));
            $data['image'] = request()->image->hashName();
        }
        //return ($image);
        Notification::create($data);
        
        $data['image'] = asset('uploads/notification_images/'.$data['image']);
        //dd($data);
        $body = [
            'data'=> $data , 
            'notification' => $data,
            //'to' => $tokens[3]
            'registration_ids' => $tokens
        ];

        $client = new Client(['headers' => $header]);
        
        $res = $client->post('https://fcm.googleapis.com/fcm/send',[
            'body' => json_encode($body),
        ]);   
        //dd($res);
        session()->flash('success', __('site.sended_successfully'));
        return view('dashboard.notifications.edit');

        //dd(json_decode($res->getBody()));

    }


        
 
}
