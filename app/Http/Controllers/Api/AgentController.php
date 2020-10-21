<?php

namespace App\Http\Controllers\Api;

use App\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgentResource;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AgentController extends Controller
{
    use ApiResponseTrait;
    
    public function register(Request $request){
    
            $validate = Validator::make(request()->all(),[
                'plan_id'     => 'required',
                'name'     => 'required',
                'identity_number'     => 'required|unique:agents',
                'city_id'     => 'required',
                'email'     => 'required|unique:agents',
                'location'     => 'required',
                'phone'     => 'required|unique:agents',
                'job_id'        => 'required',
                'services'      => 'required|min:1',
                'experience'    => 'required',
                'experience_years'    => 'required',
                'hourly_wage'    => 'required',
                'password'    => 'required|confirmed',
                'identity_image'    => 'required',
            ]);
    
            if($validate->fails())
            {
                return $this->ApiResponse(true , $validate->errors()->all() , __('api.validation_error') , [] ,200);
            }
    
            $data = $request->except(['password', 'password_confirmation','image','identity_image' ,'country_id','services']);
            $data['password'] = bcrypt($request->password);
            $data['active'] = 1;
            
            if($request->has('image')){
                $data['image'] = upload_image_base64('agent_images',$request->image);
            }

            if($request->has('identity_image')){
                $data['identity_image'] = upload_image_base64('agent_images',$request->identity_image);
            }
    
            $dt1 = new DateTime();
            $today = $dt1->format("Y-m-d");
            $dt2 = new DateTime("+1 month");
            $date = $dt2->format("Y-m-d");

            $data['expire_date'] =  $date;
           
            $agent = Agent::create($data);
            
            if($agent)
            {
                $agent->services()->syncWithoutDetaching([1,2]);
                $agent->api_token = str_random(100);
                $agent->save();
                            
                return $this->ApiResponse(true , [] , __('api.client') , new AgentResource($agent) ,200);
            }
            return $this->ApiResponse(true , [__('api.back_end_error')] , __('api.back_end_error') , [] ,200);
    }

    public function login()
    {
        $validate = Validator::make(request()->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validate->fails())
        {
            return $this->ApiResponse(true , $validate->errors()->all() , __('api.validation_error') , [] ,200);
        }
        
        $agent = Agent::where('email',request()->email)->first();

        if($agent)
        {
            if(Hash::check(request()->password, $agent->password))
            {
                $agent->api_token = str_random(100);
                $agent->save();
                return $this->ApiResponse(true , [] , __('api.login') , new AgentResource($agent) ,200);
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

        return $this->ApiResponse(true , [] , __('api.update_token') , ($member) ,200);
    }

    public function profile()
    {
        $member = request()->member;

        return $this->ApiResponse(true , [] , __('api.profile') , new AgentResource($member),200);
    }

    public function update_profile()
    {
        $rules = [];
        $member = request()->member;
        $rules += [
            'phone' => ['required' ,Rule::unique('agents','phone')->ignore($member->phone,'phone')],
            'name'  => ['required']
        ];
        
        $validate = Validator::make(request()->all(),$rules);

        if($validate->fails())
        {
            return $this->ApiResponse(true , $validate->errors()->all() , __('api.validation_error') , [] ,200);
        }

        $member->update(request()->all());
        
        return $this->ApiResponse(true , [] , __('api.profile') , new AgentResource($member),200);

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

    public function get_by_services(){

        $services = [];
        foreach ((array)request()->services as $service_id) {
            $services[] = (int)$service_id;
        } 
        dd($services);
        dd([1,2,3]);
        $agents = Agent::whereHas('services', function($query) use ($services) {
                    $query->whereIn('service_id', [1,2,3]);
                })->get();

        // $agents = Agent::whereHas('services', function($q) use($services) {
        //     $q->whereIn('service_id', $services)
        //       ->groupBy('agent_id')
        //       ->havingRaw('COUNT(DISTINCT service_id) = '.count($services));
        // })->get();
        return AgentResource::collection($agents);
    }
}