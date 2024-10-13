<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    function brand(){
        $brands = Brand::all();
        return view('backend.brand.brand',[
          'brands'=>$brands,
        ]);
    }

    function brand_store(Request $request){
        $request->validate([
       'brand_name'=> 'required',
       'brand_name'=>'unique:brands',
       'brand_logo' => ['required' ,'mimes:jpg,bmp,png','max:1024' ],

        ]);

        $logo = $request->brand_logo; // logo ta dorbe from theke
        $extension = $logo->extension();  //extension dorbe logo theke.
        $file_name = uniqid().'.'.$extension;  // logo ar 1ta name create korbe.
        Image::make($logo)->resize(300,200)->save(public_path('uploads/brand/'.$file_name)); // Image ta ke folder a save korbe..new nam soho.     'resize(300,200)' image size 300X200 kore save korbe.

        $slug = Str::lower(str_replace(' ','-', $request->brand_name)).'-'.random_int(10000000, 999999999);


        Brand::insert([
        'brand_name'=>$request->brand_name,
        'brand_logo'=>$file_name,
        'brand_slug'=>$slug,
        'created_at' =>Carbon::now(),
        ]);

        return back()->with('success','Brand Added Successfully');
    }

    function brand_delete($id){
     $brand = Brand::find($id); //Puro ginish ta ke ba id ke $brand varriable a nilam.

     $del_form = public_path('uploads/brand/'.$brand->brand_logo);  //kon path theke picture/File delet hobe seta akta varriable a nilam.
     unlink($del_form);  // unlink() function ar maddome $del_form ar file delet kore dilam.

     Brand::find($id)->delete(); // database theke sai $id kuja dalat kore dilam.

     return back()->with('brand_success','Brand Deleted successfully');
    }

    function edit_brand($id){
        $brands = Brand::find($id);
        return view('backend.brand.edit_brand',[
        'brands' =>$brands,
        ]);
    }

    function update_brand(Request $request, $id){
        $brand = Brand::find($id);
        if($request->brand_logo == ''){
            $request->validate([
                'brand_name' =>'required',
                'brand_name'=>'unique:brands',
            ]);
            $slug = Str::lower(str_replace(' ','-', $request->brand_name)).'-'.random_int(10000000, 999999999);
            brand::find($id)->update([
                'brand_name'=>$request->brand_name,
                'brand_slug'=>$slug,
                'updated_at'=>Carbon::now(),
            ]);
            return back()->with('success','Brand Updated Success fully');
        }else{
            $request->validate([
                'brand_name'  => 'required',
                'brand_name'=>'unique:brands',
                'brand_logo' => 'mimes:jpg,gif,png,jpeg', //'image'= dile sob image nibe.
                'brand_logo' => 'max:1024',
            ]);

            $delet_form = public_path('uploads/brand/'.$brand->brand_logo);
            unlink($delet_form);

            $brand= $request->brand_logo;  //Chobita ka dorlam.
            $extension = $brand->extension();
            $file_name = uniqid().'.'.$extension;
            $slug = Str::lower(str_replace(' ','-', $request->brand_name)).'-'.random_int(10000000, 999999999);

            Image::make($brand)->save(public_path('uploads/brand/'.$file_name));

            Brand::find($id)->update([
                'brand_name'=>$request->brand_name,
                'brand_logo'=>$file_name,
                'brand_slug'=>$slug,
                'updated_at'=>Carbon::now(),
            ]);

            return back()->with('success','Brand Updated Success fully');
        }
    }

    function check_delete(Request $request){
    $brand_ids =$request->brand_id;
     foreach($brand_ids as $cat_id){
        Brand::find($cat_id)->delete();
    }
   return back()->with('che_success','Brand Deleted Successfully');

    }


}
