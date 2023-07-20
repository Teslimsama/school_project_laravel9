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

class FacebookAuthController extends Controller
{
    public function move(){
        return Socialite::driver('facebook')->redirect();
    }
    public function CallbackUrlFacebook(){
        try {
            $facebook_user=Socialite::driver('facebook')->user();
            $user=User::where('email' , $facebook_user->getEmail())->first();
            $dt       = Carbon::now();
            $todayDate = $dt->toDayDateTimeString();

            if (!$user) {
                $new_user = User::create([
                    'name' =>$facebook_user->getName(),
                    'email' =>$facebook_user->getEmail(),
                    'facebook_id' =>$facebook_user->getId(),
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
                Session::put('facebook_id', $user->facebook_id);
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
