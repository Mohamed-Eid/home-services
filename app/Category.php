<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name','image'];
    protected $guarded = [];
    protected  $appends = ['image_path'];


    public function ScopeParent($query){
        return $query->where('parent_id',0);
    }

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id')->with('parent');
    }

    public function children()
    {
      return $this->hasMany('App\Category', 'parent_id');
    }

    public  function getImagePathAttribute(){
        return asset('uploads/category_images/'.$this->image);
    }

    public function jobs(){
        return $this->hasMany(Job::class);
    }

    public function services(){
        return $this->hasMany(Service::class); 
    }
}
