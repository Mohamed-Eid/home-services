<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use App\Plan;

class PlanController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        return $this->ApiResponse(true , [] , __('api.plans') , PlanResource::collection(Plan::all()),200);

    }
}
