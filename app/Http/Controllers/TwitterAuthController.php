<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use DB;
// use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class TwitterAuthController extends Controller
{
    public function move(){
        return Socialite::driver('twitter')->redirect();
    }
    public function CallbackUrlTwitter(){
        try {
            $twitter_user=Socialite::driver('twitter')->user();
            $user=User::where('email' , $twitter_user->getEmail())->first();
            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            if (!$user) {
                $new_user = User::create([
                    'name' =>$twitter_user->getName(),
                    'email' =>$twitter_user->getEmail(),
                    'twitter_id' =>$twitter_user->getId(),
                    'join_date' => $todayDate,
                    
                ]);

                Auth::login($new_user);
                Toastr::success('Has been Login successfully :)', 'Success');
                return redirect()->intended('home');
            }else {
                Auth::login($user);
                // Toastr::success('Has been Login successfully :)', 'Success');
                // return redirect()->intended('home');
                // $user = Auth::User();
                Session::put('name', $user->name);
                Session::put('email', $user->email);
                Session::put('twitter_id', $user->twitter_id);
                Session::put('user_id', $user->user_id);
                Session::put('join_date', $user->join_date);
                Session::put('phone_number', $user->phone_number);
                Session::put('status', $user->status);
                Session::put('role_name', $user->role_name);
                Session::put('avatar', $user->avatar);
                Session::put('position', $user->position);
                Session::put('department', $user->department);
                Toastr::success('Login successfully :)','Success');
                return redirect()->intended('home');
                
            }
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('fail, Something went wrong   :)', 'Error');
        }
    }
}
