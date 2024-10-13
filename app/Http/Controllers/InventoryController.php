<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function add_variation(){
        $colors = Color::all();
        $sizes = Size::all();
      return view('backend.product.variation',[
        'colors'=>$colors,
        'sizes' =>$sizes,
      ]);
    }

    function color_store(Request $request){
        $request->validate([
        'color_name'=>'required|unique:colors',
        'color_code'=>'required|unique:colors',
        ]);
         Color::insert([
            'color_name'=>$request->color_name,
            'color_code'=>$request->color_code,
            'created_at'=>Carbon::now(),
         ]);
         return back()->with('success','Color Added Successfully');
    }
    function size_store(Request $request){
        $request->validate([
        'size_name'=>'required|unique:sizes',
        ]);
       Size::insert([
       'size_name'=>$request->size_name,
       'created_at'=>Carbon::now(),
       ]);
       return back()->with('success1','Color Added Successfully');
    }

    function color_delete($id){
        Color::find($id)->delete();
        return back()->with('success_delete','Color Deleted Successfully');
    }

    function color_edit($id){
        $colors = Color::find($id);
        return view('backend.product.color_edit',[
            'colors'=>$colors,
        ]);
    }

    function color_update(Request $request,$id){
        $request->validate([
        'color_name'=>'required|unique:colors',
        'color_code'=>'required|unique:colors',
        ]);
        Color::find($id)->update([
        'color_name'=>$request->color_name,
        'color_code'=>$request->color_code,
        'updated_at'=>Carbon::now()
        ]);
        return back()->with('success','Color Updated Successfully');
    }

    function size_edit($id){
        $sizes = Size::find($id);
        return view('backend.product.size_edit',[
            'sizes'=>$sizes,
        ]);
    }

    function size_update(Request $request, $id){
      $request->validate([
       'size_name'=>'required|unique:sizes',
      ]);
      Size::find($id)->update([
        'size_name'=>$request->size_name,
        'updated'=>Carbon::now(),
      ]);
      return back()->with('success','Size Updated Successfully');
    }

    function inventory($id){
        $products =Product::find($id);
        $colors = Color::all();
        $sizes = Size::all();
        $inventories = Inventory::where('product_id', $id)->get();
        return view('backend.product.inventory',[
            'colors'=>$colors,
            'sizes'=> $sizes,
            'products'=>$products,
            'inventories'=>$inventories,
        ]);
    }

    function inventory_store(Request $request, $id){
        if(Inventory::where('product_id', $id)->where('color_id', $request->color_id)->where('size_id',$request->size_id)->exists()){
            Inventory::where('product_id', $id)->where('color_id', $request->color_id)->where('size_id',$request->size_id)->increment('quantity',$request->quantity);
            return back()->with('success','Inventory Quantity Updated Successfully');
        }else{
            $product = Product::find($id);

            Inventory::insert([
                'product_id'=>$id,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
                'quantity'=>$request->quantity,
                'price'=>$request->price,
                'after_discount'=>$request->price - ($request->price * $product->discount / 100),
                'created_at'=>Carbon::now(),
               ]);
               return back()->with('success','Inventory Added Successfully');
        }

    }

    function inventory_delete($id){
        Inventory::find($id)->delete();

        return back()->with('success_delete','Inventory Deleted Successfully');
    }

}
