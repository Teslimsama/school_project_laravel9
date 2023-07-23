<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\TypeFormController;
use App\Http\Controllers\Setting;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\DepartmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** for side bar menu active */
function set_active($route)
{
    if (is_array($route)) {
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', function () {
        return view('home');
    });
    Route::post('home', function () {
        return view('home');
    });
});

Auth::routes();
// ----------------------------social login------------------------------//
Route::controller(GoogleAuthController::class)->group(function () {
        Route::get('auth/google', 'move')->name('google_auth');
        Route::get('auth/google/call-back', 'CallbackUrlGoogle')->name('google_auth_call-back');
    }
);
Route::controller(FacebookAuthController::class)->group(function () {
        Route::get('auth/facebook', 'move')->name('facebook_auth');
        Route::get('auth/facebook/call-back', 'CallbackUrlFacebook')->name('facebook_auth_call-back');
    }
);
Route::controller(TwitterAuthController::class)->group(function () {
        Route::get('auth/twitter', 'move')->name('twitter_auth');
        Route::get('auth/twitter/call-back', 'CallbackUrlTwitter')->name('twitter_auth_call-back');
    }
);
Route::controller(LinkedinAuthController::class)->group(function () {
        Route::get('auth/linkedin', 'move')->name('linkedin_auth');
        Route::get('auth/linkedin/call-back', 'CallbackUrlLinkedin')->name('linkedin_auth_call-back');
    }
);

// ----------------------------login ------------------------------//
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout');
    Route::post('change/password', 'changePassword')->name('change/password');
});

// ----------------------------- register -------------------------//
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'storeUser')->name('register');
});

// -------------------------- main dashboard ----------------------//
Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->middleware('auth')->name('home');
    Route::get('user/profile/page', 'userProfile')->middleware('auth')->name('user/profile/page');
    Route::get('teacher/dashboard', 'teacherDashboardIndex')->middleware('auth')->name('teacher/dashboard');
    Route::get('student/dashboard', 'studentDashboardIndex')->middleware('auth')->name('student/dashboard');
});

// ----------------------------- user controller -------------------------//
Route::controller(UserManagementController::class)->group(function () {
    Route::get('list/users', 'index')->middleware('auth')->name('list/users');
    Route::post('change/password', 'changePassword')->name('change/password');
    Route::get('view/user/edit/{id}', 'userView')->middleware('auth');
    Route::post('user/update', 'userUpdate')->name('user/update');
    Route::post('user/delete', 'userDelete')->name('user/delete');
});

// ------------------------ setting -------------------------------//
Route::controller(Setting::class)->group(function () {
    Route::get('setting/page', 'index')->middleware('auth')->name('setting/page');
    Route::get('setting/email', 'EmailSettings')->middleware('auth')->name('setting/email');
    Route::get('setting/payment', 'Payment')->middleware('auth')->name('setting/payment');
    Route::get('setting/sociallogin', 'SocialLogin')->middleware('auth')->name('setting/sociallogin');
    Route::get('setting/sociallinks', 'SocialLinks')->middleware('auth')->name('setting/sociallinks');
    Route::get('setting/seosettings', 'SeoSettings')->middleware('auth')->name('setting/seosettings');
    Route::get('setting/othersettings', 'OtherSettings')->middleware('auth')->name('setting/othersettings');
    Route::post('setting/updatesociallinks', 'UpdateSocialLinks')->middleware('auth')->name('setting/updatesociallinks');
    Route::post('setting/updateseosettings', 'UpdateSeoSettings')->middleware('auth')->name('setting/updateseosettings');
    Route::post('setting/googleanalytics', 'OtherSettingsUpdate')->middleware('auth')->name('setting/googleanalytics');
    Route::post('setting/googleadsensecode', 'OtherSettingsUpdate')->middleware('auth')->name('setting/googleadsensecode');
    Route::post('setting/facebookmessenger', 'OtherSettingsUpdate')->middleware('auth')->name('setting/facebookmessenger');
    Route::post('setting/facebookpixel', 'OtherSettingsUpdate')->middleware('auth')->name('setting/facebookpixel');
    Route::post('setting/googlerecaptcha', 'OtherSettingsUpdate')->middleware('auth')->name('setting/googlerecaptcha');
    Route::post('setting/cookiesagreement', 'OtherSettingsUpdate')->middleware('auth')->name('setting/cookiesagreement');
    Route::post('setting/address', 'Address')->middleware('auth')->name('setting/address');
    Route::post('setting/webupdate', 'WebsiteBasicDetailsUpdate')->middleware('auth')->name('setting/update');
});

// ------------------------ student -------------------------------//
Route::controller(StudentController::class)->group(function () {
    Route::get('student/list', 'student')->middleware('auth')->name('student/list'); // list student
    Route::get('student/grid', 'studentGrid')->middleware('auth')->name('student/grid'); // grid student
    Route::get('student/add/page', 'studentAdd')->middleware('auth')->name('student/add/page'); // page student
    Route::post('student/add/save', 'studentSave')->name('student/add/save'); // save record student
    Route::get('student/edit/{id}', 'studentEdit'); // view for edit
    Route::post('student/update', 'studentUpdate')->name('student/update'); // update record student
    Route::post('student/delete', 'studentDelete')->name('student/delete'); // delete record student
    Route::get('student/profile/{id}', 'studentProfile')->middleware('auth'); // profile student
});

// ------------------------ teacher -------------------------------//
Route::controller(TeacherController::class)->group(function () {
    Route::get('teacher/add/page', 'teacherAdd')->middleware('auth')->name('teacher/add/page'); // page teacher
    Route::get('teacher/list/page', 'teacherList')->middleware('auth')->name('teacher/list/page'); // page teacher
    Route::get('teacher/grid/page', 'teacherGrid')->middleware('auth')->name('teacher/grid/page'); // page grid teacher
    Route::post('teacher/save', 'saveRecord')->middleware('auth')->name('teacher/save'); // save record
    Route::get('teacher/edit/{id}', 'editRecord'); // view teacher record
    Route::post('teacher/update', 'updateRecordTeacher')->middleware('auth')->name('teacher/update'); // update record
    Route::post('teacher/delete', 'teacherDelete')->name('teacher/delete'); // delete record teacher
});

// ----------------------- department -----------------------------//
Route::controller(DepartmentController::class)->group(function () {
    Route::get('department/list/page', 'listDepartment')->middleware('auth')->name('department/list/page'); // page list department
    Route::get('department/add/page', 'indexDepartment')->middleware('auth')->name('department/add/page'); // page add department
    Route::post('department/add/save', 'saveDepartment')->middleware('auth')->name('department/add/save'); // page add department
    Route::post('department/update', 'departmentUpdate')->middleware('auth')->name('department/update'); // page add department
    Route::post('department/delete', 'deleteDepartment')->middleware('auth')->name('department/delete'); // page add department
    Route::get('department/edit/{id}', 'editDepartment')->middleware('auth'); // page edit  department
});
