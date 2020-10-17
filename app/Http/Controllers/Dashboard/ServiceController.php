<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::when($request->search , function ($q) use ($request){
            return $q->whereTranslationLike('name','%'.$request->search.'%');
        })->latest()->paginate(5);


        return view('dashboard.services.index' , compact('services'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.services.create',compact('categories'));
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
            'category_id' => 'required|numeric'
        ];

        foreach (config('translatable.locales') as $locale){
            $rules += [$locale.'.name' => ['required' ,Rule::unique('service_translations','name')]];
        }

        $request->validate($rules);
        
        $data = $request->all();
        
        //dd($data);
        Service::create($data);

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.services.index');
    }

    public function edit(Service $service)
    {
        $categories = Category::all();

        return view('dashboard.services.edit', compact('service','categories'));
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $rules = [
            'category_id' => 'required|numeric'
        ];

        foreach (config('translatable.locales') as $locale){
            $rules += [$locale.'.name' => ['required' ,Rule::unique('service_translations','name')->ignore($service->id,'service_id')]];
        } 

        $request->validate($rules);

        $data = $request->all();



        
        $service->update($data);

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.services.index');
    }

    public function destroy(Service $service)
    {

        $service->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.services.index');
    } 
}
