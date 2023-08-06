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
use App\Http\Controllers\subjectController;
use App\Http\Controllers\blankPageController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\FeeCollectionController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\PaymentController;

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
// for set status color
function status($status)
{
    if ($status ===  'Paid') {
        return 'success';
    } elseif ($status ===  'Unpaid') {
        return 'danger';
    } else {
        return 'warning';
    }
}
function librarystatus($status)
{
    if ($status ===  'In Stock') {
        return 'success';
    } else {
        return 'danger';
    }
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
Route::controller(GoogleAuthController::class)->group(
    function () {
        Route::get('auth/google', 'move')->name('google_auth');
        Route::get('auth/google/call-back', 'CallbackUrlGoogle')->name('google_auth_call-back');
    }
);
Route::controller(FacebookAuthController::class)->group(
    function () {
        Route::get('auth/facebook', 'move')->name('facebook_auth');
        Route::get('auth/facebook/call-back', 'CallbackUrlFacebook')->name('facebook_auth_call-back');
    }
);
Route::controller(TwitterAuthController::class)->group(
    function () {
        Route::get('auth/twitter', 'move')->name('twitter_auth');
        Route::get('auth/twitter/call-back', 'CallbackUrlTwitter')->name('twitter_auth_call-back');
    }
);
Route::controller(LinkedinAuthController::class)->group(
    function () {
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

// ----------------------- subject -----------------------------//
Route::controller(subjectController::class)->group(function () {
    Route::get('subject/list/page', 'listSubject')->middleware('auth')->name('subject/list/page'); // page list department
    Route::post('subject/delete', 'subjectDelete')->name('subject/delete'); // delete record teacher
    Route::get('subject/add/page', 'subjectIndex')->middleware('auth')->name('subject/add/page'); // page add department
    Route::post('subject/add/save', 'saveSubject')->middleware('auth')->name('subject/add/save'); // page add department
    Route::post('subject/update', 'subjectUpdate')->middleware('auth')->name('subject/update'); // page add department
    Route::get('subject/edit/{id}', 'editSubject')->middleware('auth'); // page edit  department

});

// ----------------------- event -----------------------------//
Route::controller(FullCalendarController::class)->group(function () {
    Route::get('/getevent', 'getEvent')->name('getevent');
    Route::post('/createevent', 'createEvent')->name('createevent');
    Route::post('/deleteevent', 'deleteEvent')->name('deleteevent');
    Route::post('updateevent', 'updateEvent')->name('updateevent');
});

Route::controller(FeeCollectionController::class)->group(function () {
    Route::get('feescollection/page', 'Feescollection')->name('feescollection/page');
    Route::get('feescollection/page/add', 'FeescollectionAdd')->name('feescollection/page/add');
    Route::post('feescollection/save', 'FeescollectionSave')->name('feescollection/save');
    Route::post('feescollection/update', 'FeescollectionUpdate')->name('feescollection/update');
    Route::post('feescollection/delete', 'FeescollectionDelete')->name('feescollection/delete');
    Route::get('feescollection/edit/{id}', 'FeescollectionEdit')->middleware('auth');
    Route::put('feecollection/updatedata/{id}', 'update')->name('updatedata/feecollection');
});

Route::controller(FeesController::class)->group(function () {
    Route::get('fees/page', 'Fees')->name('fees/page');
    Route::get('fees/page/add', 'addFees')->name('fees/page/add');
    Route::post('fees/save', 'saveFees')->name('fees/save');
    Route::post('fees/update', 'updateFees')->name('fees/update');
    Route::post('fees/delete', 'deleteFees')->name('fees/delete');
    Route::get('fees/edit/{id}', 'editFees')->middleware('auth'); // page edit  department


});
Route::controller(ExpensesController::class)->group(function () {
    Route::get('expenses/page', 'Expenses')->name('expenses/page');
    Route::get('expenses/add/page', 'expensesAdd')->middleware('auth')->name('expenses/add/page'); // page expenses
    Route::post('expenses/add/save', 'expensesSave')->name('expenses/add/save'); // save record expenses
    Route::get('expenses/edit/{id}', 'expensesEdit'); // view for edit
    Route::post('expenses/update', 'expensesUpdate')->name('expenses/update'); // update record expenses
    Route::post('expenses/delete', 'expensesDelete')->name('expenses/delete'); // delete record expenses
});
Route::controller(SalaryController::class)->group(function () {
    Route::get('salary/page', 'salary')->name('salary/page');
    Route::get('salary/add/page', 'salaryAdd')->middleware('auth')->name('salary/add/page'); // page expenses
    Route::post('salary/add/save', 'salarySave')->name('salary/add/save'); // save record salary
    Route::get('salary/edit/{id}', 'salaryEdit'); // view for edit
    Route::post('salary/update', 'salaryUpdate')->name('salary/update'); // update record expenses
    Route::put('salary/updatedata/{id}', 'update')->name('salary/update-data');
    Route::post('salary/delete', 'salaryDelete')->name('salary/delete'); // delete record salary
});

// ----------------------- blank page -----------------------------//
Route::controller(ExamController::class)->group(function () {
    Route::get('exam/page', 'Exam')->name('exam/page');
    Route::get('exam/add/page', 'examAdd')->middleware('auth')->name('exam/add/page'); // page exam
    Route::post('exam/add/save', 'examSave')->name('exam/add/save'); // save record exam
    Route::get('exam/edit/{id}', 'examEdit'); // view for edit
    Route::post('exam/update', 'examUpdate')->name('exam/update'); // update record exam
    Route::post('exam/delete', 'examDelete')->name('exam/delete'); // delete record exam
    Route::get('/get_subjects_classes', 'getSubjectsClasses');
});
// ----------------------- blank page -----------------------------//
Route::controller(TimeTableController::class)->group(function () {
    Route::get('timetable/page', 'Timetable')->name('timetable/page');
    Route::get('timetable/add/page', 'TimetableAdd')->middleware('auth')->name('timetable/add/page'); // page timetable
    Route::post('timetable/add/save', 'TimetableSave')->name('timetable/add/save'); // save record timetable
    Route::get('timetable/edit/{id}', 'TimetableEdit'); // view for edit
    Route::post('timetable/update', 'TimetableUpdate')->name('timetable/update'); // update record timetable
    Route::post('timetable/delete', 'TimetableDelete')->name('timetable/delete'); // delete record timetable
    Route::get('/get_subjects_teacher', 'getSubjectsTeacher');
});
Route::controller(LibraryController::class)->group(function () {
    Route::get('library/page', 'library')->name('library/page');
    Route::get('library/add/page', 'libraryAdd')->middleware('auth')->name('library/add/page'); // page library
    Route::post('library/add/save', 'librarySave')->name('library/add/save'); // save record library
    Route::get('library/edit/{id}', 'libraryEdit'); // view for edit
    Route::post('library/update', 'libraryUpdate')->name('library/update'); // update record library
    Route::post('library/delete', 'elibraryelete')->name('library/delete'); // delete record library
    Route::get('/getdepartment', 'getdepartmentClasses');
    Route::put('library/updatedata/{id}', 'update')->name('library/update-data');
});
// ----------------------- blank page -----------------------------//
Route::controller(blankPageController::class)->group(function () {
    Route::get('blank/page', 'LetsGo')->name('blank/page');
});
// -----------------------  paystack payment -----------------------------//
Route::controller(PaymentController::class)->group(function () {
    Route::post('/pay', 'redirectToGateway')->name('pay');
    Route::get('/payment/callback', 'handleGatewayCallback');
});
