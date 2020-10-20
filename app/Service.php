<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];
    protected $guarded = [];
    
    public function agents()
    {
        return $this->belongsToMany(Agent::class)->withTimestamps();;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
