<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $guarded = [];
    protected  $appends = ['image_path','identity_image_path'];

    public  function getImagePathAttribute(){
        return asset('uploads/agent_images/'.$this->image);
    }

    public  function getIdentityImagePathAttribute(){
        return asset('uploads/agent_images/'.$this->identity_image);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }


    public function services()
    {
        return $this->hasMany(Service::class)->withTimestamps();
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }
    
}
