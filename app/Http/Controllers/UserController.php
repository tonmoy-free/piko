<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    function user_edit(){
         return view('backend.user.edit');
    }
// Data Update Korar Niom...
    function user_update(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
        ],[
            //error messege gulo
            'name.required'=>'Please name dan',
            'email.email'=>'Please tik eamil address dan',
           // 'email.unique'=>'ai eamil address alrady ache',
        ]);

        User::find(Auth::id())->update([
          'name'=>$request->name,
          'email'=>$request->email,
        ]);
        return back()->with('success', 'User Updated'); // 'success'->session ar name,, 'User Updated' session ar message
   }
   function password_update(Request $request){
      $request->validate([
        'current_password' => 'required',
        'password' => ['required', 'confirmed', Password::min(8) ->letters()->mixedCase()->numbers()->symbols()],
        'password_confirmation' => 'required',

      ]);
      if(password_verify($request->current_password, Auth::user()->password)){
       User::find(Auth::id())->update([
        'password' =>bcrypt($request->password), //bcrypt() -> jate password encrypted thake.
       ]);
       return back()->with('pass_update', 'Password Updated');
      }else{
        return back()->with('curnt', 'Current Password Wrong');
      }
   }


   function user_photo_update(Request $request){
    $request->validate([
      'profile_photo' => 'required',
      'profile_photo' => 'mimes:jpg,bmp,png', //'image'= dile sob image nibe.
      'profile_photo' => 'max:1024',
    ]);

    //folder theke delet korao code.
    if(Auth::user()->image !=null){
       $delet_from = public_path('/uploads/user/'.Auth::user()->image);
       unlink($delet_from);
    }else{

    }
    $photo = $request->profile_photo;
    $extension = $photo->extension();
    $File_name = Auth::id().'.'.$extension;
    Image::make($photo)->resize(300, 200)->save(public_path('uploads/user/'.$File_name));
    User::find(Auth::id())->update([
     'image'=>$File_name,
    ]);
    return back()->with('photo_update','Profile Photo Updated');
   }

   function user_list(){
    $users = User::all();
    return view('backend.user.user_list', [
      'users' => $users,
    ]);
   }

   function user_delete($id){
     User::find($id)->delete();
     return back()->with('del','User delete success');
   }
}
