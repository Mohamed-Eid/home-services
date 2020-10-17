<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Job::when($request->search , function ($q) use ($request){
            return $q->whereTranslationLike('name','%'.$request->search.'%');
        })->latest()->paginate(5);


        return view('dashboard.jobs.index' , compact('jobs'));
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.jobs.create',compact('categories'));
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
            $rules += [$locale.'.name' => ['required' ,Rule::unique('job_translations','name')]];
        }

        $request->validate($rules);
        
        $data = $request->all();
        
        //dd($data);
        Job::create($data);

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.jobs.index');
    }

    public function edit(Job $job)
    {
        $categories = Category::all();

        return view('dashboard.jobs.edit', compact('job','categories'));
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $rules = [
            'category_id' => 'required|numeric'
        ];

        foreach (config('translatable.locales') as $locale){
            $rules += [$locale.'.name' => ['required' ,Rule::unique('job_translations','name')->ignore($job->id,'job_id')]];
        } 

        $request->validate($rules);

        $data = $request->all();



        
        $job->update($data);

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.jobs.index');
    }

    public function destroy(Job $job)
    {

        $job->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.jobs.index');
    } 

}
