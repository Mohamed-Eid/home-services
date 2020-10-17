<?php

namespace App\Http\Controllers\Dashboard;

use App\City;
use App\Client;
use App\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;

class DashboardController extends Controller
{
    public function index(){
        $cities_count     = City::count();

        $users_count      = User::whereRoleIs('admin')->count();
        
        return view('dashboard.index' , compact('cities_count','users_count'));
    }// end of index
}
