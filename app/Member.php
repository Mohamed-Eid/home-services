<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];
    public $appendns = ['active_status','active_data'];
    public function orders(){
        return $this->hasMany(\App\Order::class);
    }

    public function getActiveAttribute($val)
    {
        return [
            'ar' => [
                0 => 'غير مفعل',
                1 => 'مفعل',
            ],
            'en' => [
                0 => 'Inactive',
                1 => 'Active',
            ]
        ][app()->getLocale()][$val];
    }
    
    
    public function getActiveDataAttribute($val)
    {
        return [
            'ar' => [
                0 => 'غير مفعل',
                1 => 'مفعل',
            ],
            'en' => [
                0 => 'Inactive',
                1 => 'Active',
            ]
        ][app()->getLocale()];
    }

    public function getActiveStatusAttribute()
    {
        return $this->attributes['active'];
    }
}
