<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Client;
use App\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\DelivertimeResource;
use App\Events\NewProductHasOrdered;
use App\Order;
use App\Product;
use App\Subdetail;
use App\Deliverytime;
use App\Http\Resources\ShoppingCartResource;
use App\ShoppingCart;
use App\Size;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Tax;
use App\Mail\NewOrderMail;
use App\Member;

class OrderController extends Controller
{
    use ApiResponseTrait;


    private function get_sub_details($ids)
    {
        $subdetails = [];
        foreach ($ids as $id) {
            $subdetail = Subdetail::find($id);
            if(!$subdetail)
            {
                return $this->ApiResponse(true , [__('api.subdetail_not_found')] , __('api.subdetail_not_found') , [] ,200);
            }
            $subdetails[] = $subdetail;

        }
        return collect($subdetails);
    }

    private function find_subdetails_cost($sub_details,$price_type=0)
    {
        $sub_details_price = 0;
        foreach ($sub_details as $subdetail) {
            //$sub_details_price += $subdetail->price;
            if($price_type == 0)
            {
                $sub_details_price += $subdetail->price_by_kilo;
            }else{
                $sub_details_price += $subdetail->price_by_piece;
            }
        }
        return $sub_details_price;
    }

    private function details_cart($sub_details)
    {
        $data = [];
        foreach ($sub_details as $subdetail) {
            $data[] = [
                "detail_id" => $subdetail->detail->id,
                "subdetail_id" => $subdetail->id
            ];
        }
        return $data;
    }

    private function check_if_exist(Client $client,$data)
    {
        $cart = ShoppingCart::where('product_id', $data['product_id'])
            ->where('details', json_encode($data['details']))
            ->where('client_id', $client->id)
            ->where('price_type', $data['price_type'])->first();
        return $cart;
    }

    public function add_to_cart()
    {
        //validation
        $validate = Validator::make(request()->all(),[
            'product_id'    => 'required',
            'price_type'    => 'required|integer|min:0|max:1',
            'quantity'      => 'required|integer|min:1',
            'sub_details'   => 'sometimes|array'
        ]);
        
        if($validate->fails())
        {
            return $this->ApiResponse(true , $validate->errors()->all() , __('api.validation_error') , [] ,200);
        }

        //get client from request
        $client = request()->client;

        //find if product exist
        $product = Product::find(request()->product_id);
        if(!$product)
        {
            return $this->ApiResponse(true , [__('api.product_not_found')] , __('api.product_not_found') , [] ,200);
        }
               

        //process subdetails
        $sub_details = $this->get_sub_details(request()->sub_details);
        //cacl price
        $price_type = request()->price_type;
        $sub_details_price = $this->find_subdetails_cost($sub_details,$price_type);
        
        if($price_type == 0)
        {
            $price = ($product->price_by_kilo + $sub_details_price) * request()->quantity;
        }else{
            $price = ($product->price_by_piece + $sub_details_price) * request()->quantity;
        }

        

        //cart details to save as obj in db
        $detail_cart = $this->details_cart($sub_details);
        
        $data = [
            'product_id'    => $product->id,
            'quantity'      => request()->quantity,
            'price_type'    => $price_type,
            'price'         => $price,
            'details'       => $detail_cart,
        ];
        if($this->check_if_exist($client,$data) != null){
            $cart = $this->check_if_exist($client,$data);
            $cart->quantity += request()->quantity;
            $cart->price += $price; 
            $cart->save();
        }else{
            $cart = $client->shopping_carts()->create($data);
        }

        
        if($cart)
        {
            return $this->ApiResponse(true , [] , __('api.added_to_cart') , $cart ,200);
        }

        return $this->ApiResponse(true , [__('api.backend_error')] , __('api.backend_error') , [] ,200);

    }

    
    public function carts()
    {
        $client = request()->client;

        $carts = ShoppingCartResource::collection(ShoppingCart::where('client_id',$client->id)->where('checked','0')->get());
        
        $total_price=0;
        foreach($carts as $cart){
            $total_price += ($cart->price);
            // $total_price += ($cart->price*$cart->quantity);

        }
        
        $data = [
            'carts'              => $carts,
            'total_carts_price'  => $total_price,
            'tax'                => calc_tax_on_price($total_price),//Tax::first()->tax,
            'delivery_cost'      => request()->client->district->delivered_cost,
            ];
            
        $data += [
                'total_price_after_adding_tax_and_delivery_cost' => $data['total_carts_price'] + $data['tax'] + $data['delivery_cost'],
            ];

        return $this->ApiResponse(true , [] , __('api.all_cart') , $data ,200);

    }
    

    public function delete_from_cart($cart)
    {
        $cart = ShoppingCart::find($cart);
        if($cart)
        {
            if($cart->checked == 1)
            {
                return $this->ApiResponse(true , [__('api.ordered_before')] , __('api.ordered_before') , [] ,200);  
            }
            if(request()->client != $cart->client)
            {
                return $this->ApiResponse(true , [__('api.access_denaied')] , __('api.access_denaied') , [] ,200);
            }else{
                $cart->delete();
                return $this->ApiResponse(true , [] , __('site.deleted_successfully'), ['products_count'=>request()->client->shopping_carts->count()] ,200);
            }
        }
        return $this->ApiResponse(true , [__('api.cart_not_found')] , __('api.cart_not_found') , [] ,200);
    }

    
    public function check_coupon()
    {
       // dd(request()->coupon);
        if(request()->coupon)
        {
           $coupon = Coupon::where('coupon',request()->coupon)->first();
            if($coupon){
                $coupon->expired = false;
                if(!$coupon->expire_date >= date('Y-m-d'))
                {
                    $coupon->expired = true;
                    return $this->ApiResponse(true , [__('site.coupon_expired')] , __('site.coupon_expired') , $coupon ,200);

                }else{
                    return $this->ApiResponse(true , [] , __('api.coupon') , $coupon ,200);
                }
            } else{
                return $this->ApiResponse(true , [__('site.coupon_not_found')] , __('site.coupon_not_found') , $coupon ,200);
 
            }
        }

    }
    
    private function assign_order_to_member()
    {
        $latest_order_member_id = Order::latest()->first()->member_id ?? null;
        if($latest_order_member_id){
            $last_member = Member::where('id', '>',$latest_order_member_id)->orderBy('id')->first();
            if($last_member)
            {
                $next_member_id = $last_member->id;
            }else{
                $next_member_id = Member::first()->id; 
            }
        }
        else{
            $next_member_id = Member::first()->id ?? null;
        }
        return $next_member_id;
    }

    public function checkout()
    {
        try {
            $client = request()->client;
            $validate = Validator::make(request()->all(),[
                'cart_id'    => 'required|array|min:1',
                'location' => 'required',
                'payment_method' => 'required'
            ]);
            if($validate->fails())
            {
                return $this->ApiResponse(true , $validate->errors()->all() , __('api.validation_error') , [] ,200);
            }
    
    
            $carts = [];
            $total_cost = $client->district->delivered_cost ;//+  calc_tax_on_price(); //Tax::first()->tax;
            foreach(request()->cart_id as $id) {
                $cart = ShoppingCart::find($id);
                $cart = new ShoppingCartResource($cart);
    
                $carts[] = $cart;
                $total_cost += ($cart->price*$cart->quantity);
            }
           // return ($carts);
            $coupon = null;
            if(request()->coupon)
            {
                $coupon = Coupon::where('coupon',request()->coupon)->first();
    
                if($coupon && $coupon->expire_date >= date('Y-m-d'))
                {
                    $total_cost -= $total_cost * ($coupon->offer/100);
                }
            }
            
            $total_cost = $total_cost + calc_tax_on_price($total_cost);

            $order = $client->orders()->create([
                'member_id' => $this->assign_order_to_member(),
                'carts' => $carts,
                'notes' => request()->notes,
                'status' => 1,
                'location' => request()->location,
                'payment_method' => request()->payment_method,
                'total_price'   => $total_cost,
                'discount' => $coupon == null ? 0 : $coupon->offer.' %',     
            ]);
    
            if($order)
            {      
                foreach ($carts as $cart) {
                    $cart->product->orders += 1;
                    $cart->product->save();
                }  
                foreach ($carts as $cart) {
                    $cart->delete();
                }
                
                return $this->ApiResponse(true , [] , __('api.ordered') , $order ,200);
            }
            
            return $this->ApiResponse(true , [__('api.backend_error')] , __('api.backend_error') , [] ,200);

        }catch (Exception $e) {
            return $this->ApiResponse(true , [__('api.you_must_login')] , __('api.you_must_login') , [] ,200);
        }
        
    }
    
    private function send_mails_to_admins($order)
    {
        $admins = User::all();
        $emails = [];
        foreach ($admins as $admin) {
            if($admin->hasPermission('read_orders'))
            {
                $user['email'] = $admin->email;
                $emails[] = $user;
            }
        }
        Mail::to($emails)->send(new NewOrderMail($order));
    }
    
    public function delivery_times()
    {
        return $this->ApiResponse(true , [] , __('site.delivery_times') , DelivertimeResource::collection(Deliverytime::all()) ,200);
    }
    
    public function get_client_orders()
    {
        $orders = Order::where('client_id',request()->client->id)->get();
        //return $orders;
        return $this->ApiResponse(true , [] , __('site.orders') , OrderResource::collection($orders) ,200);

    }

    public function get_client_order_by_id($order)
    {
        $order =  Order::find($order);
        if(!$order)
        {
            return $this->ApiResponse(true , [__('site.no_records')] , __('site.orders') ,[] ,200);
        }

        if(request()->client->id != $order->client_id)
        {
            return $this->ApiResponse(true , [__('api.access_denaied')] , __('api.access_denaied') , [] ,200);
        }
        
        $carts = $this->process_order($order);
        $total = 0;
        
        foreach ($carts as $cart) {
            $total += ($cart->quantity * $cart->price);
        }
        $data =  [
            'order'               => $order,
            'carts'               => $carts,
            'total'               => $total,
            'total_with_delivery' => $total + request()->client->district->delivered_cost,
        ];
        return $this->ApiResponse(true , [] , __('site.orders') ,$data ,200);


    }

    public function process_order(Order $order)
    {
        $carts = $order->carts;
        $carts_id = explode(',' , $carts);

        $cart_objs = [];
        foreach($carts_id as $id)
        {
           array_push($cart_objs , new CartResource(Cart::find($id))); 
        }
        return $cart_objs;
    }


}