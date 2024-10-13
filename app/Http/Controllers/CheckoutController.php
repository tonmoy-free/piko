<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\City;
use App\Models\Inventory;
use App\Models\order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
function getcity(Request $request){
    $str = '';
    $cities = City::where('country_id',$request->country_id)->get();
    foreach($cities as $city){
        $str .= '<option value="'.$city->id.'">'.$city->name.'</option>';
    }

    echo $str;


}


function order_confirm(Request $request){
 if($request->payment == 1){
    $order_id = 'order'.'-'.random_int(10000000,90000000);
    order::insert([
     'customer_id'=> Auth::guard('customer')->id(),
     'order_id'=>$order_id,
     'discount'=>$request->discount,
     'charge'=>$request->charge,
     'total'=>$request->sub_total - $request->charge,
     'created_at'=>Carbon::now(),

    ]);

    Billing::insert([
   'customer_id'=> Auth::guard('customer')->id(),
   'order_id'=>$order_id,
   'fname'=>$request->fname,
   'lname'=>$request->lname,
   'country_id'=>$request->country_id,
   'city_id'=>$request->city_id,
   'zip'=>$request->zip,
   'company'=>$request->company,
   'email'=>$request->email,
   'phone'=>$request->phone,
   'address'=>$request->address,
   'notes'=>$request->notes,
   'created_at'=>Carbon::now(),
    ]);

    if($request->ship_check == 1){
    Shipping::insert([
    'customer_id'=> Auth::guard('customer')->id(),
    'order_id'=>$order_id,
    'ship_fname'=>$request->ship_fname,
    'ship_lname'=>$request->ship_lname,
    'ship_country_id'=>$request->ship_country_id,
    'ship_city_id'=>$request->ship_city_id,
    'ship_zip'=>$request->ship_zip,
    'ship_company'=>$request->ship_company,
    'ship_email'=>$request->ship_email,
    'ship_phone'=>$request->ship_phone,
    'ship_address'=>$request->ship_address,
    'created_at'=>Carbon::now(),
    ]);
    }

    $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
    foreach($carts as $cart){
        OrderProduct::insert([
        'customer_id'=> Auth::guard('customer')->id(),
        'order_id'=>$order_id,
        'product_id'=>$cart->product_id,
        'price' => $cart->rel_to_inventory->where('product_id', $cart->product_id)->where        ('color_id' , $cart->color_id)->where('size_id', $cart->size_id)->first()->after_discount,
        'color_id'=>$cart->color_id,
        'size_id'=>$cart->size_id,
        'quantity' =>$cart->quantity,
        'created_at'=>Carbon::now(),
        ]);

   //     Inventory::where('product_id', $cart->product_id)->where('color_id',  $cart->color_id)->where('size_id',  $cart->size_id)->decrement('quantity', $cart->quantity);
   //     $carts->find($cart->id)->delete();
    }
   //sending invoice mail
    Mail::to($request->email)->send(new InvoiceMail($order_id));

    return redirect()->route('order.success');

 }else if($request->payment == 2){
     echo 'ssl';
 }else if($request->payment == 3){
    $data = $request->all();
    return redirect()->route('stripe')->with('data', $data);
}
}

function order_success(){
return view('frontend.order_success');
}
}
