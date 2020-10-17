<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name',];
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
