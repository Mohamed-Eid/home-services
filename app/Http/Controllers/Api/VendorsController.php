<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vendor;
use App\Http\Resources\VendorResource;
use App\Http\Resources\ProductResource;

class VendorsController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        return $this->ApiResponse(true , [] , __('api.vendors') , VendorResource::collection(Vendor::all()) ,200);
    }
        
    public function special_vendors()
    {
        return $this->ApiResponse(true , [] , __('api.vendors') , VendorResource::collection(Vendor::where('special',1)->get()) ,200);
    }
    
    public function products(Vendor $vendor)
    {
        $products = $vendor->products()->has('images')->get();
        return $this->ApiResponse(true , [] , __('api.products') , ProductResource::collection($products) ,200);
    }
}
