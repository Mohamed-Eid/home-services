<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Http\Resources\OrderResource;
use App\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    use ApiResponseTrait;

    
    public function register_member(Request $request)
    {
        // dd(request()->all());

        $validate = Validator::make(request()->all(),[
            'name'        => 'required',
            'mobile'      => 'required|unique:members',
            'password'    => 'required|confirmed',
        ]);

        if($validate->fails())
        {
            return $this->ApiResponse(true , $validate->errors()->all() , __('api.validation_error') , [] ,200);
        }

        $data = $request->except(['password', 'password_confirmation' ]);
        $data['password'] = bcrypt($request->password);
        $data['active'] = 1;


        $member = Member::create($data);
        if($member)
        {
            $member->api_token = str_random(100);
            $member->save();
                        
            return $this->ApiResponse(true , [] , __('api.client') , new MemberResource($member) ,200);
        }
        return $this->ApiResponse(true , [__('api.back_end_error')] , __('api.back_end_error') , [] ,200);

    }

    public function login()
    {
        $validate = Validator::make(request()->all(),[
            'mobile' => 'required',
            'password' => 'required',
        ]);

        if($validate->fails())
        {
            return $this->ApiResponse(true , $validate->errors()->all() , __('api.validation_error') , [] ,200);
        }
        
        $member = Member::where('mobile',request()->mobile)->first();

        if($member)
        {
            if(Hash::check(request()->password, $member->password))
            {
                $member->api_token = str_random(100);
                $member->save();
                return $this->ApiResponse(true , [] , __('api.login') , new MemberResource($member) ,200);
            }              
        }

        return $this->ApiResponse(true , [__('auth.failed')] , __('auth.failed'), [] ,200);


    }

    public function update_fcm_token()
    {
        $validate = Validator::make(request()->all(),[
            'fcm_token' => 'required',
        ]);

        if($validate->fails())
        {
            return $this->ApiResponse(true , $validate->errors()->all() , __('api.validation_error') , [] ,200);
        }
        

        $member = request()->member;
        $member->update([
            'fcm_token' => request()->fcm_token
        ]);

        return $this->ApiResponse(true , [] , __('api.update_token') , new MemberResource($member) ,200);
    }

    public function profile()
    {
        $member = request()->member;

        return $this->ApiResponse(true , [] , __('api.profile') , new MemberResource($member) ,200);
    }

    public function update_profile()
    {
        $rules = [];
        $member = request()->member;
        $rules += [
            'mobile' => ['required' ,Rule::unique('members','mobile')->ignore($member->mobile,'mobile')],
            'name'  => ['required']
        ];
        
        $validate = Validator::make(request()->all(),$rules);

        if($validate->fails())
        {
            return $this->ApiResponse(true , $validate->errors()->all() , __('api.validation_error') , [] ,200);
        }

        $member->update(request()->all());
        
        return $this->ApiResponse(true , [] , __('api.profile') , new MemberResource($member) ,200);

    }

    public function change_password()
    {
        //validateion
        $validate = Validator::make(request()->all(), [
            'old_password' => 'required',
            'new_password'     => 'required',
        ]);
        if($validate->fails())
        {
            return $this->ApiResponse(true , $validate->errors()->all() , __('api.validation_error') , [] ,200);
        }


        $member = request()->member;

        if(Hash::check(request()->old_password, $member->password))
        {
            $member->update([
                'password' => bcrypt(request()->new_password),
            ]);
            return $this->ApiResponse(true , [] , __('api.password_changed') , [] ,200);
        }
        return $this->ApiResponse(true , [__('api.wrong_password')] , __('api.wrong_password'), [] ,200);
    }

    public function orders()
    {
        $member = request()->member;
        //dd($member);
        return $this->ApiResponse(true , [] , __('api.orders') , OrderResource::collection($member->orders) ,200);
    }
}
