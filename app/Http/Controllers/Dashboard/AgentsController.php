<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;

class AgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::latest()->paginate(10);
        return view('dashboard.agents.index',compact('members'));    
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $agent)
    {
        $orders = $agent->orders()->paginate(5);
        return view('dashboard.agents.show',compact('agent','orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $agent)
    {
        $orders = $agent->orders()->paginate(5);
        return view('dashboard.agents.edit',compact('agent','orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $agent)
    {
        request()->validate([
            'active' => 'required',
        ]);
    

        $agent->update(\request()->all());
        
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.agents.edit',$agent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $agent)
    {
        $agent->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.agents.index');
    }
}
