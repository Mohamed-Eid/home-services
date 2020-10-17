<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notification;

class Client extends Model
{
    protected $guarded = [];
    protected $appends = ['city_id','address','admin_mobile','active_status'];


    protected $hidden = ['district' , 'created_at' , 'updated_at'];

    public function district()
    {
        return $this->belongsTo(District::class);
    } 

    public function getAddressAttribute()
    {
        if( $this->district == null || $this->district->city == null)
        {
            return 'deleted city or district';
        }
        return $this->district->name .', '. $this->district->city->name;
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
    
    
    public function getActiveStatusAttribute()
    {
        return $this->attributes['active'];
    }

    public function getCityIdAttribute()
    {
        return strval($this->district->city->id);
    }
    
    public function  getAdminMobileAttribute()
    {
        return ServiceNumber::first()->number;
    }
    
    public function orders(){
        return $this->hasMany(\App\Order::class);
    }
    
    public function special_orders(){
        return $this->hasMany(\App\SpecialOrder::class);
    }

    public function codes()
    {
        return $this->hasMany(\App\Code::class);
    }

    public function shopping_carts()
    {
        return $this->hasMany(\App\ShoppingCart::class);
    }
    
    public function notifications()
    {
        return Notification::where('client_id',null)->orWhere('client_id',$this->id)->get();
    }

    public function favorites(){
        return $this->hasMany(\App\ShoppingCart::class);
    }
    
    
}
