<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];
    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function agents(){
        return $this->hasMany(Agent::class);
    }

    public function clients(){
        return $this->hasMany(Client::class);
    }

}
