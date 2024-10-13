<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Tag;
use App\Models\Thumbnail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function add_product(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $tags = Tag::all();
        return view('backend.product.add_product',[
          'categories' =>$categories,
          'subcategories' =>$subcategories,
          'brands'=>$brands,
          'tags'=>$tags,
        ]);
    }

    function getsubcategory(Request $request){
      $subcategories = Subcategory::where('category_id', $request->category_id)->get();
      $sub ='<option value="">Select Sub Category</option>';
      foreach($subcategories as $subcategory){
        $sub .='<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>';
    }
    echo $sub;
}

function product_store(Request $request){
  $after_implode = implode(',',$request->tag_id);   //implode function-> array ke string a convert kore.
  $slug = Str::lower(str_replace(' ','-', $request->product_name)).'-'.random_int(10000000, 999999999);

  $preview =$request->preview;
  $extension = $preview->extension();
  $file_name = uniqid().'.'.$extension;
  Image::make($preview)->resize(700,700)->save(public_path('uploads/product/preview/'.$file_name));

    $product_id = Product::insertGetId([
        'category_id'=>$request->category_id,
        'subcategory_id'=>$request->subcategory_id,
        'brand_id'=>$request->brand_id,
        'product_name'=>$request->product_name,
  //      'price'=>$request->price,
        'discount'=>$request->discount,
  //      'after_discount'=>$request->price - ($request->price * $request->discount / 100),
        'short_desp'=>$request->short_desp,
        'long_desp'=>$request->long_desp,
        'additional_info'=>$request->additional_info,
        'tags'=>$after_implode,
        'slug'=>$slug,
        'preview'=>$file_name,
        'created_at'=>Carbon::now(),
       ]);

       $thumbnails = $request->thumbnails;
       foreach($thumbnails as $thumb){
        $slug2 = Str::lower(str_replace(' ','-', $request->product_name)).'-'.random_int(10000000, 999999999);
        $extension2 = $thumb->extension();
        $file_name2 = uniqid().'.'.$extension2;
        Image::make($thumb)->resize(700,700)->save(public_path('uploads/product/thumbnail/'.$file_name2));
        Thumbnail::insert([
        'product_id' =>$product_id,
        'thumbnail' =>$file_name2,
        'created_at'=>Carbon::now(),
        ]);
       }

       return back()->with('success','Product Added Successfully.');

}


   function product_list(){
    $products = Product::latest()->get();
   return view('backend.product.list',[
    'products' =>$products,
   ]);
   }

    function product_view($id){
     $product = Product::find($id);
     return view('backend.product.view',[
      'product'=>$product,
     ]);
    }
    function product_delete($id){
     $product = Product::find($id);
     $preview_delete_form = public_path('uploads/product/preview/'.$product->preview);
     unlink($preview_delete_form);

     $galleries =Thumbnail::where('product_id', $id)->get();
     foreach($galleries as $gal){
        $gallery_delete_form = public_path('uploads/product/thumbnail/'.$gal->thumbnail);
        unlink($gallery_delete_form);
        Thumbnail::find($gal->id)->delete();
     }

     Product::find($id)->delete();
     return back()->with('success','Product Deleted Successfully.');
    }

}
