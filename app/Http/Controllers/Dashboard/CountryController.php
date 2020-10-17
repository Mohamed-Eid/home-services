<?php

namespace App\Http\Controllers\Dashboard;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = Country::when($request->search , function ($q) use ($request){
            return $q->whereTranslationLike('name','%'.$request->search.'%');
        })->latest()->paginate(5);


        return view('dashboard.countries.index' , compact('countries'));
    } 

 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.countries.create');
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
        ];

        foreach (config('translatable.locales') as $locale){
            $rules += [$locale.'.name' => ['required' ,Rule::unique('country_translations','name')]];
        }
        
        $data = $request->all();


        $request->validate($rules);

        Country::create($data);

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.countries.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('dashboard.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale){
            $rules += [$locale.'.name' => ['required' ,Rule::unique('country_translations','name')->ignore($country->id,'country_id')]];
        }
        $data = $request->all();


        $request->validate($rules);

        $country->update($data);

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.countries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        
        $country->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.countries.index');
    }
}
