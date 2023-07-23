<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Hash;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function register()
    {
        $role = DB::table('role_type_users')->get();
        return view('auth.register', compact('role'));
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'role_name' => 'required|string|max:255',
            'password'  => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $dt       = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();

        User::create([
            'name'      => $request->name,
            'avatar'    => $request->image,
            'email'     => $request->email,
            'join_date' => $todayDate,
            'role_name' => $request->role_name,
            'password'  => Hash::make($request->password),
        ]);
        Toastr::success('Create new account successfully :)', 'Success');
        return redirect('login');
        // teslithe code below  works i'll leave it here just incase
         // Define the allowed roles
        // $allowedRoles = ['Super Admin', 'Admin', 'Accounting', 'Student', 'Teachers'];

        // // Example: Retrieve the user's role from the session
        // // Replace this with the actual method to get the user's role from the session
        // $userRole = $request->role_name; // Assuming 'role_name' is the key in the session holding the user's role

        // if (in_array($userRole, $allowedRoles)) {
        //     if ($userRole === 'Super Admin') {
        //         $dt       = Carbon::now();
        //         $todayDate = $dt->toDayDateTimeString();

        //         User::create([
        //             'name'      => $request->name,
        //             'avatar'    => $request->image,
        //             'email'     => $request->email,
        //             'join_date' => $todayDate,
        //             'role_name' => $request->role_name,
        //             'password'  => Hash::make($request->password),
        //         ]);
        //         Toastr::success('Create new account successfully :)', 'Success');
        //         return redirect('login');
        //     } elseif ($userRole === 'Admin') {
        //         $dt       = Carbon::now();
        //         $todayDate = $dt->toDayDateTimeString();

        //         User::create([
        //             'name'      => $request->name,
        //             'avatar'    => $request->image,
        //             'email'     => $request->email,
        //             'join_date' => $todayDate,
        //             'role_name' => $request->role_name,
        //             'password'  => Hash::make($request->password),
        //         ]);
        //         Toastr::success('Create new account successfully :)', 'Success');
        //         return redirect('login');
        //     } elseif ($userRole === 'Accounting') {
        //         $dt       = Carbon::now();
        //         $todayDate = $dt->toDayDateTimeString();

        //         User::create([
        //             'name'      => $request->name,
        //             'avatar'    => $request->image,
        //             'email'     => $request->email,
        //             'join_date' => $todayDate,
        //             'role_name' => $request->role_name,
        //             'password'  => Hash::make($request->password),
        //         ]);
        //         Toastr::success('Create new account successfully :)', 'Success');
        //         return redirect('login');
        //     } elseif ($userRole === 'Student') {
        //         $dt       = Carbon::now();
        //         $todayDate = $dt->toDayDateTimeString();

        //         Student::create([
        //             'name'      => $request->name,
        //             'avatar'    => $request->image,
        //             'email'     => $request->email,
        //             'join_date' => $todayDate,
        //             'role_name' => $request->role_name,
        //             'password'  => Hash::make($request->password),
        //         ]);
        //         Toastr::success('Create new account successfully :)', 'Success');
        //         return redirect('login');
        //     } elseif ($userRole === 'Teachers') {
        //         $dt       = Carbon::now();
        //         $todayDate = $dt->toDayDateTimeString();

        //         Teacher::create([
        //             'full_name'      => $request->name,
        //             'avatar'    => $request->image,
        //             'email'     => $request->email,
        //             'joining_date' => $todayDate,
        //             'role_name' => $request->role_name,
        //             'password'  => Hash::make($request->password),
        //         ]);
        //         Toastr::success('Create new account successfully :)', 'Success');
        //         return redirect('login');
        //     }
        // } else {
        //     // Content for other roles not listed in $allowedRoles
        //     echo "<p>Welcome, User!</p>";
        // }
    }
}
