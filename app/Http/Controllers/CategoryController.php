<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
     function add_category(){
        $categories = Category::all();
        return view('backend.category.add_category',[
            'categories' => $categories,
        ]);
     }

     function store_category(CategoryRequest $request){
      $category_image = $request ->category_image;
      $extension = $category_image->extension();
      $file_name = uniqid().'.'.$extension;
      $slug = Str::lower(str_replace(' ','-', $request->category_name)).'-'.random_int(10000000, 999999999);



      Image::make($category_image)->save(public_path('uploads/category/'.$file_name));

      Category::insert([
          'category_name'=>$request->category_name,
          'category_image'=>$file_name,
          'category_slug' => $slug,
          'created_at' =>Carbon::now(),
      ]);

      return back()->with('success', 'New Category Added');

     }

     function del_category($id){
        $category  = Category::find($id);
        // $delet_form = public_path('uploads/category/'.$category->category_image);
        // unlink($delet_form);

        Category::find($id)->delete();

        return back()->with('delete', 'New Category Deleted');

     }

     function edit_category($id){
      $category_info = Category::find($id);
      return view('backend.category.edit',[
         'category_info'=> $category_info,
        ]) ;
     }

     function update_category(Request $request, $id){
        $category =Category::find($id);
      if($request->category_image == ''){
        $request->validate([
            'category_name'  => 'unique:categories',
        ]);
         Category::find($id)->update([
        'category_name' => $request->category_name,
         ]);

         return back()->with('update', 'Category Updated');
      }else{
        $request->validate([
            'category_name'  => 'unique:categories',
            'category_image' => 'mimes:jpg,gif,png,jpeg', //'image'= dile sob image nibe.
            'category_image' => 'max:1024',
        ]);

        $delet_form = public_path('uploads/category/'.$category->category_image);
        unlink($delet_form);


        $category_image = $request ->category_image;
        $extension = $category_image->extension();
        $file_name = uniqid().'.'.$extension;
        $slug = Str::lower(str_replace(' ','-', $request->category_name)).'-'.random_int(10000000, 999999999);



        Image::make($category_image)->save(public_path('uploads/category/'.$file_name));


        Category::find($id)->update([
            'category_name' => $request->category_name,
            'category_image' => $file_name,
             ]);

             return back()->with('update', 'Category Updated');

      }
     }

    function  trash_category(){
        $trashed =Category::onlyTrashed()->get();
        return view('backend.Category.trash',[
            'trashed' => $trashed,
        ]);
    }

    function restore_category($id){
     Category::onlyTrashed()->find($id)->restore();

     return back();
    }

    function hard_del_category($id){
        $category  = Category::onlyTrashed()->find($id);
        $delet_form = public_path('uploads/category/'.$category->category_image);
        unlink($delet_form);

        Category::onlyTrashed()->find($id)->forceDelete();

        return back()->with('delete', 'New Category Deleted Permanantly');
    }

    function check_delete(Request $request){
    $category_ids =$request->category_id;
    foreach($category_ids as $cat_id){
        Category::find($cat_id)->delete();
    }
    return back();

}

    function restore_checked(Request $request){
       if($request->abc == 1){
        $category_ids =$request->category_id;
        foreach($category_ids as $cat_id){
            Category::onlyTrashed()->find($cat_id)->restore();
        }
        return back();
       }else{
        $category_ids =$request->category_id;
        foreach($category_ids as $cat_id){
            $category = Category::onlyTrashed()->find($cat_id);
            $delete_frm = public_path('uploads/category/'.$category->category_image);
            unlink($delete_frm);
            Category::onlyTrashed()->find($cat_id)->forceDelete();
        }
        return back();
       }


    }

}
