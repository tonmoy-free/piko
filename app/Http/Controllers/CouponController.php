<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function coupon(){
        $coupons = Coupon::all();
       return view('backend.coupon.coupon',[
        'coupons'=>$coupons,
       ]);
    }

    function coupon_store(Request $request){
    Coupon::insert([
    'coupon_name'=>$request->coupon_name,
    'type' =>$request->type,
    'amount'=>$request->amount,
    'validity'=>$request->validity,
    'created_at'=>Carbon::now(),
    ]);
    return back()->with('success','Coupon Added!');
    }

    function coupon_del($id){
     Coupon::find($id)->delete();
     return back();
    }
}
