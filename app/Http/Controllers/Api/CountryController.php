<?php

namespace App\Http\Controllers\Api;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        return $this->ApiResponse(true , [] , __('api.countries') , CountryResource::collection(Country::all()),200);

    }

    public function cities(Country $country){
        return $this->ApiResponse(true , [] , __('api.cities') , CityResource::collection($country->cities),200);
    }
}
