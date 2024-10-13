<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagContrller extends Controller
{
    function tags(){
        $tags = Tag::paginate(5);
        return view('backend.tag.tags', [
        'tags'=>$tags,
        ]);
    }
    function tag_store(Request $request){
     $request->validate([
     'tag_name'=>'required|unique:tags',
     ]);

     $slug = Str::lower(str_replace(' ','-', $request->tag_name)).'-'.random_int(10000000, 999999999);

     Tag::insert([
      'tag_name' =>$request->tag_name,
      'tag_slug' => $slug,
      'created_at' =>Carbon::now(),
     ]);

     return back()->with('success','Tag Added Successfully');
    }

    function tag_delete($id){
    Tag::find($id)->delete();

    return back()->with('tag_success','Tag Deleted Successfully');
    }
    function edit_tag($id){
        $tags = Tag::find($id);
        return view('backend.tag.edit_tag',[
            'tags' =>$tags,
        ]);
    }

    function update_tag(Request $request, $id){
        $request->validate([
            'tag_name'=>'required',
        ]);

        $slug = Str::lower(str_replace(' ','-', $request->tag_name)).'-'.random_int(10000000, 999999999);

        Tag::find($id)->update([
            'tag_name'=> $request->tag_name,
            'tag_slug'=>$slug,
            'updated_at'=>Carbon::now(),
        ]);

        return back()->with('success','Tag Updated Successfully');
    }
}
