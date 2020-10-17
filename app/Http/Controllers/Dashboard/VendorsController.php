<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vendor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */  
    public function index(Request $request)
    {
        //dd('index');
        $vendors = Vendor::when($request->search , function ($q) use ($request){
            return $q->whereTranslationLike('name','%'.$request->search.'%');
        })->latest()->paginate(5);
        //dd($vendors);
        return view('dashboard.vendors.index' , compact('vendors'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.vendors.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required|numeric',
            'address'     =>  'required',
            'lat'         =>  'required',
            'lng'       =>  'required',
        ];

        foreach (config('translatable.locales') as $locale){
            $rules += [$locale.'.name' => ['required' ,Rule::unique('vendor_translations','name')]];
            $rules += [$locale.'.description' => ['required']];
        }

        $request->validate($rules);
        
        $data = $request->all();
        //dd($data);
        $data['image'] = 'default.png';

        if($request->has('image')) {
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->save(public_path('uploads/vendor_images/' . $request->image->hashName()));
             $data['image'] = $request->image->hashName();
        }
        
        //dd($data);
        $vendor = Vendor::create($data);
        //dd($vendor);
        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.vendors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        $categories = Category::all();

        return view('dashboard.vendors.edit', compact('vendor','categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $rules = [
            'category_id' => 'required|numeric',
            'address'     =>  'required',
            'lat'         =>  'required',
            'lng'       =>  'required',
        ];

        foreach (config('translatable.locales') as $locale){
            $rules += [$locale.'.name' => ['required' ,Rule::unique('vendor_translations','name')->ignore($vendor->id,'vendor_id')]];
            $rules += [$locale.'.description' => ['required']];
        }

        //$request->validate($rules);
        //dd($request->all());
        $data = $request->all();

        if($request->has('image')) {
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->save(public_path('uploads/vendor_images/' . $request->image->hashName()));
             $data['image'] = $request->image->hashName();
        }
        
        //dd($data);
        $vendor->update($data);
        //dd($vendor);
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.vendors.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
