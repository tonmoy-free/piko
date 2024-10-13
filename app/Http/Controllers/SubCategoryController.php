<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    function subcategory(){
      $categories =Category::all();
      $subcategories = Subcategory::all();
      return view('backend.category.subcategory',[
     'categories'=>$categories,
     'subcategories'=>$subcategories,
      ]);
    }

    function subcategory_store(Request $request){
        $request->validate([
       'category_id'=>'required',
       'subcategory_name'=>'required',
        ],[
            'category_id.required'=>'Category Name Is Required',
        ]);

        if(Subcategory::where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()){
            return back()->with('exists', 'Subcategory Name Alrady Exists in this category');
        }else{
            Subcategory::insert([
                'category_id'=> $request->category_id,
                'subcategory_name'=> $request->subcategory_name,
                'created_at'=> Carbon::now(),
            ]);
            return back()->with('success', 'Subcategory Added Successfully!');
        }

    }
    function edit_subcategory($id){
       $categories = Category::all();
       $subcategory_info = Subcategory::find($id);
      return view('backend.category.edit_subcategory',[
        'categories'=>$categories,
        'subcategory_info' => $subcategory_info,
      ]);
    }

    function subcategory_update(Request $request, $id){
     Subcategory::find($id)->update([
       'category_id' => $request->category_id,
       'subcategory_name' => $request->subcategory_name,
       'updated_at' =>Carbon::now(),
     ]);

     return back()->with('success','Updated Successfully');
    }

    function delete_subcategory($id){
     Subcategory::find($id)->delete();
     return back()->with('exists', 'SubCategory Deleted');
    }
}
