<?php

namespace App\Http\Controllers\Dashboard;

use App\Cart;
use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;

class SaleController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['permission:read_sales'])->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $cities = City::all();

        $id = $request->city_id ?? City::first()->id;

        if(!$request->city_id)
        {
            $request->city_id =  City::first()->id;
        }

        $currency = City::find($id)->translate(app()->getLocale())->currency;
        //dd($currency);

        $orders = Order::where('status', 3)
            ->when($request->city_id , function ($q) use ($request) {
                return $q->join('clients','orders.client_id','clients.id')
                ->join('districts','clients.district_id','districts.id')
                ->select('orders.*')
                ->where('city_id',$request->city_id);
            })->get();
        
        //return ($orders);
        
        $total = 0;
        $profit = 0 ;
        $subdetails_profits = 0;
        foreach ($orders as $order) {
            $total = $order->total_price;
        }

        return view('dashboard.sales.index' , compact('orders' ,'cities' , 'profit','currency' ,'total','subdetails_profits'));
    }


}
