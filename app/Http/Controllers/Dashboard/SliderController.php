<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Slider;
use App\Vendor;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index(){
        $slider = new Slider();
        $sliders = Slider::all();
        $products = Product::all();
        $categories = Category::where('parent_id','!=',0)->get();
        $vendors = Vendor::all();
        return view('dashboard.slider.index',compact('slider','sliders','products','categories','vendors'));
    }

    
    public function upload_images(Request $request)
    {
        //dd($images);
        $rules = [
            'type'  => 'required|integer|min:0|max:2',
            'image' => 'required',
            'parent_id' => 'required',
        ];  

        $request->validate($rules);
        
        $data = \request()->all();

        //return \request()->all();

        if ($request->image) {
            Image::make($request->image)->
            save(public_path('uploads/slider_images/' . $request->image->hashName()));
            $data['image'] = $request->image->hashName();
        }

        $slider = Slider::create($data);

        return redirect()->route('dashboard.slider.index');

    } 

    public function destroy(Slider $slider)
    {
        File::delete(
            $slider->image_public_path
        );
        $slider->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.slider.index');
    }
}
