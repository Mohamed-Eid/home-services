<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailResource;
use App\Http\Resources\OneProductResource;
use App\Http\Resources\ProductResource;
use App\Product;

class ProductController extends Controller
{
    use ApiResponseTrait;

    public function get_all()
    { 
        $products = Product::has('images')->get();

        return $this->ApiResponse(true , [] , __('api.all_products') , ProductResource::collection($products) ,200);
    }

    public function search(Request $request)
    {
        $products = Product::when($request->name, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->name . '%');

        })->get();
        return $this->ApiResponse(true , [] , __('api.all_products') , ProductResource::collection($products) ,200);
    }

    public function index(Request $request)
    {
        $products = Product::has('images')->when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->when($request->city_id, function ($q) use ($request) {

            return $q->where('city_id', $request->city_id);

        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);

        })->get();
        return $this->ApiResponse(true , [] , __('api.all_products') , ProductResource::collection($products) ,200);

    }


    public function get_one(Product $product)
    {
        //dd(request()->client);
        $data = new ProductResource($product);
        
        return $this->ApiResponse(true , [] , __('api.all_products') , $data ,200);
    }

    public function get_latest_products()
    {
        $products = Product::has('images')->latest()->take(10)->get();

        return $this->ApiResponse(true , [] , __('api.all_products') , ProductResource::collection($products) ,200);
    }
   
    public function get_most_ordered_products()
    {
        return $this->ApiResponse(true , [] , __('api.all_products') , ProductResource::collection(       
            Product::where('orders','>','0')
            ->orderBy('orders', 'DESC')
            ->take(10)
            ->get()
            ) ,200);
    }
}
