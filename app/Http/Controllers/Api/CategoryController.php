<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Vendor;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        return $this->ApiResponse(true , [] , __('api.categories') , CategoryResource::collection(Category::all()) ,200);
    }
    
    public function products(Category $category)
    {
        $products = $category->products()->has('images')->get();
        return $this->ApiResponse(true , [] , __('api.products') , ProductResource::collection($products) ,200);
    }
    
    /**
     * ==============    v2    =============== *
     */
    public function vendors(Category $category)
    {
        return $this->ApiResponse(true , [] , __('api.vendors') , $category->vendors ,200);
    }
    
    public function categories(){
        return $this->ApiResponse(true , [] , __('api.categories') , CategoriesResource::collection(Category::all()) ,200);
    }
    
    public function categories_home(){
        $order = 'desc';
        
        $categories = Category::with(['products' => function ($q) use ($order) {
            $q->orderBy('orders', $order);
        }])->where('parent_id',0)->has('products')->paginate(10);
        
        return $this->ApiResponse(true , [] , __('api.categories') , CategoriesResource::collection($categories) ,200);
    }

    public function get_products_by_sub_category(Category $category){
        $products = $category->products;
        return $this->ApiResponse(true , [] , __('api.categories') , ProductResource::collection($products) ,200);
    }

    public function get_products_by_vendor(Vendor $vendor){
        $products = $vendor->products;
        return $this->ApiResponse(true , [] , __('api.categories') , ProductResource::collection($products) ,200);
    }


}
