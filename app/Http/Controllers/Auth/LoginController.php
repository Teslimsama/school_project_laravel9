<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use App\Rules\MatchOldPassword;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }
    /** index page login */
    public function login()
    {
        return view('auth.login');
    }

    /** login with databases */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        DB::beginTransaction();
        try {

            $email     = $request->email;
            $password  = $request->password;

            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                /** get session */
                $user = Auth::User();
                Session::put('name', $user->name);
                Session::put('email', $user->email);
                Session::put('user_id', $user->user_id);
                Session::put('join_date', $user->join_date);
                Session::put('phone_number', $user->phone_number);
                Session::put('status', $user->status);
                Session::put('role_name', $user->role_name);
                Session::put('avatar', $user->avatar);
                Session::put('position', $user->position);
                Session::put('department', $user->department);
                // remove the code below if wantsellabeg

                // Define the allowed roles
                $allowedRoles = ['Super Admin', 'Admin', 'Accounting', 'Student', 'Teachers'];

                // Example: Retrieve the user's role from the session
                // Replace this with the actual method to get the user's role from the session
                $userRole = Session::get('role_name'); // Assuming 'role_name' is the key in the session holding the user's role
                if (in_array($userRole, $allowedRoles)) {
                    if ($userRole === 'Super Admin') {
                        Toastr::success('Login successfully :)', 'Success');
                        return redirect()->intended('home');
                    } elseif ($userRole === 'Admin') {
                        Toastr::success('Login successfully :)', 'Success');
                        return redirect()->intended('home');
                    } elseif ($userRole === 'Accounting') {
                        Toastr::success('Login successfully :)', 'Success');
                        return redirect()->intended('home');
                    } elseif ($userRole === 'Student') {
                        Toastr::success('Login successfully :)', 'Success');
                        return redirect()->intended('student/dashboard');
                    } elseif ($userRole === 'Teachers') {
                        Toastr::success('Login successfully :)', 'Success');
                        return redirect()->intended('teacher/dashboard');
                    }
                }
// stop

                // Toastr::success('Login successfully :)', 'Success');
                // return redirect()->intended('home');
            } else {
                Toastr::error('fail, WRONG USERNAME OR PASSWORD :)', 'Error');
                return redirect('login');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, LOGIN :)', 'Error');
            return redirect()->back();
        }
    }

    /** logout */
    public function logout(Request $request)
    {
        Auth::logout();
        // forget login session
        $request->session()->forget('name');
        $request->session()->forget('email');
        $request->session()->forget('user_id');
        $request->session()->forget('join_date');
        $request->session()->forget('phone_number');
        $request->session()->forget('status');
        $request->session()->forget('role_name');
        $request->session()->forget('avatar');
        $request->session()->forget('position');
        $request->session()->forget('department');
        $request->session()->flush();

        Toastr::success('Logout successfully :)', 'Success');
        return redirect('login');
    }
}
