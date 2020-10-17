<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Slider;

class SliderController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        return $this->ApiResponse(true , [] , __('api.slider') , SliderResource::collection(Slider::all()) ,200);
    }
}
