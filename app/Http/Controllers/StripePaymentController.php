<?php

namespace App\Http\Controllers;

use App\Models\StripeOrder;
use Illuminate\Http\Request;
use Session;
use Stripe;
use DB;
use App\Models\Sslorder;
use App\Mail\InvoiceMail;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\City;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        $data = session('data');
        $id = StripeOrder::insertGetId([
         'customer_id'=>$data['customer_id'],
         'total'=>$data['sub_total']+$data['charge'],
         'discount'=>$data['discount'],
         'charge'=>$data['charge'],
         'fname'=>$data['fname'],
         'lname'=>$data['lname'],
         'email'=>$data['email'],
         'phone'=>$data['phone'],
         'address'=>$data['address'],
         'zip'=>$data['zip'],
         'country_id'=>$data['country_id'],
         'city_id'=>$data['city_id'],
         'company'=>$data['company'],
         'notes'=>$data['notes'],
         'ship_fname'=>$data['ship_fname'],
         'ship_lname'=>$data['ship_lname'],
         'ship_country_id'=>$data['ship_country_id'],
         'ship_city_id'=>$data['ship_city_id'],
         'ship_zip'=>$data['ship_zip'],
         'ship_company'=>$data['ship_company'],
         'ship_email'=>$data['ship_email'],
         'ship_phone'=>$data['ship_phone'],
         'ship_address'=>$data['ship_address'],
         'ship_check'=>$data['ship_check'],


        ]);

        $ttal = $data['sub_total']+$data['charge'];
        return view('frontend.stripe',[
         'id'=>$id,
          'total'=>$ttal,
        ]);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request, $id)
    {
      //  echo $id;
       $data = StripeOrder::find($id);
       return $data;
       Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

       Stripe\Charge::create ([
               "amount" => 100 * $data->total,
               "currency" => "bdt",
               "source" => $request->stripeToken,
               "description" => "Test payment from itsolutionstuff.com."
       ]);

    //   Session::flash('success', 'Payment successful!');

  //     return back();

// $tran_id =$request->input('tran_id');
// $data = Sslorder::where('transaction_id', $tran_id)->first();

$order_id = 'order'.'-'.random_int(10000000, 90000000);
Order::insert([
'customer_id'=>$data->customer_id,
'order_id'=>$order_id,
'discount'=>$data->discount,
'charge'=>$data->charge,
'total'=>$data->total,
'created_at'=>Carbon::now(),

]);
Billing::insert([
    'customer_id'=>$data->customer_id,
    'order_id'=>$order_id,
    'fname'=>$data->fname,
    'lname'=>$data->lname,
    'country_id'=>$data->country_id,
    'city_id'=>$data->city_id,
    'zip'=>$data->zip,
    'company'=>$data->company,
    'email'=>$data->email,
    'phone'=>$data->phone,
    'address'=>$data->address,
    'notes'=>$data->notes,
    'created_at'=>Carbon::now(),
]);
if($data->ship_check ==1 ){
Shipping::insert([
    'customer_id'=>$data->customer_id,
    'order_id'=>$order_id,
    'ship_fname'=>$data->ship_fname,
    'ship_lname'=>$data->ship_lname,
    'ship_country_id'=>$data->ship_country_id,
    'ship_city_id'=>$data->ship_city_id,
    'ship_zip'=>$data->ship_zip,
    'ship_company'=>$data->ship_company,
    'ship_email'=>$data->ship_email,
    'ship_phone'=>$data->ship_phone,
    'ship_address'=>$data->address,
    'created_at'=>Carbon::now(),
]);
}
$carts = Cart::where('customer_id', $data->customer_id)->get();
foreach($carts as $cart){
 OrderProduct::insert([
  'customer_id'=>$data->customer_id,
  'order_id'=>$order_id,
  'product_id'=>$cart->product_id,
  'price'=>$cart->rel_to_inventory->where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->first()->after_discount,
  'color_id'=>$cart->color_id,
  'size_id'=>$cart->size_id,
  'quantity'=>$cart->quantity,
  'created_at'=>Carbon::now(),
 ]);

 Inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);

 $cart->find($cart->id)->delete();
}

//sending invoice mail
Mail::to($data->email)->send(new InvoiceMail($order_id));

return redirect()->route('order_success');


    }
}
