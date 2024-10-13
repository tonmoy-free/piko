<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{

    //github
    function github_redirect(){
        return Socialite::driver('github')->redirect();
    }

    function github_callback(){
        $user = Socialite::driver('github')->user();

        if(Customer::where('email', $user->getEmail())->exists()){
            if(Auth::guard('customer')->attempt(['email'=>$user->getEmail(), 'password'=>'pass@123'])){
                return redirect('/');
            }
        }else{
            Customer::updateOrCreate([
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'password'=>bcrypt('pass@123'),
                'created_at'=>Carbon::now(),
               ]);
               if(Auth::guard('customer')->attempt(['email'=>$user->getEmail(), 'password'=>'pass@123'])){
                return redirect('/');
            }
        }

    }


    //google
    function google_redirect(){
        return Socialite::driver('google')->redirect();
    }

    function google_callback(){
        $user = Socialite::driver('google')->user();

        if(Customer::where('email', $user->getEmail())->exists()){
            if(Auth::guard('customer')->attempt(['email'=>$user->getEmail(), 'password'=>'pass@123'])){
                return redirect('/');
            }
        }else{
            Customer::updateOrCreate([
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'password'=>bcrypt('pass@123'),
                'created_at'=>Carbon::now(),
               ]);
               if(Auth::guard('customer')->attempt(['email'=>$user->getEmail(), 'password'=>'pass@123'])){
                return redirect('/');
            }
        }

    }

}
