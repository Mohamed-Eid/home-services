<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResourece;
use App\Job;

class ServiceController extends Controller
{
    use ApiResponseTrait;

    public function get_services_by_category(Category $category){
        return $this->ApiResponse(true , [] , __('api.plans') , ServiceResourece::collection($category->services),200);
    }

    public function get_services_by_job(Job $job){
        return $this->ApiResponse(true , [] , __('api.plans') , ServiceResourece::collection($job->category->services),200);
    }
}
