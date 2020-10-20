<?php

namespace App\Http\Resources;

use App\Country;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'email'            => $this->email,
            'location'         => $this->location,
            'phone'            => $this->phone,
            'experience'       => $this->experience,
            'experience_years' => $this->experience_years,
            'hourly_wage'      => $this->hourly_wage,
            'expire_date'      => $this->expire_date,
            'image'            => $this->image_path,
            'api_token'        => $this->api_token,
            'fcm_token'        => $this->fcm_token,
            'plan'             => new PlanResource($this->plan),
            'country'          => new CountryResource($this->city->country),
            'city'             => new CityResource($this->city) ,
            'job'              => new JobResourece($this->job),
           'services'          => ServiceResourece::collection($this->services),

        ];
    }
}
