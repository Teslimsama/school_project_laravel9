<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    /** home dashboard */
    // public function index()
    // {
    //     return view('dashboard.home');
    // }
    // Dashboard
    public function index()
    {

        $dataTeachers = Teacher::select('id', 'created_at')->get()->groupBy(function ($data) {
            return Carbon::parse($data->created_at)->format('M');
        });

        $dataStudents = Student::select('id', 'created_at')->get()->groupBy(function ($data) {
            return Carbon::parse($data->created_at)->format('M');
        });

        $months = [];
        $teacherCounts = [];
        $studentCounts = [];

        foreach ($dataTeachers as $month => $values) {
            $months[] = $month;
            $teacherCounts[] = count($values);
        }

        foreach ($dataStudents as $month => $values) {
            $studentCounts[] = count($values);
        }



        $dataMaleStudents = Student::select('id', 'created_at')->where('gender', 'male')->get()->groupBy(function ($data) {
            return Carbon::parse($data->created_at)->year;
        });

        $dataFemaleStudents = Student::select('id', 'created_at')->where('gender', 'female')->get()->groupBy(function ($data) {
            return Carbon::parse($data->created_at)->year;
        });

        $year = [];
        $maleStudentCounts = [];
        $femaleStudentCounts = [];

        foreach ($dataMaleStudents as $month => $values) {
            $year[] = $month;
            $maleStudentCounts[] = count($values);
        }

        foreach ($dataFemaleStudents as $month => $values) {
            $femaleStudentCounts[] = count($values);
        }

        return view('dashboard.home', [
            'months' => $months,
            'maleStudentCounts' => $maleStudentCounts,
            'femaleStudentCounts' => $femaleStudentCounts,

            'year' => $year,
            'teacherCounts' => $teacherCounts,
            'studentCounts' => $studentCounts,
        ]);
    }

    /** profile user */
    public function userProfile()
    {
        return view('dashboard.profile');
    }

    /** teacher dashboard */
    public function teacherDashboardIndex()
    {
        return view('dashboard.teacher_dashboard');
    }

    /** student dashboard */
    public function studentDashboardIndex()
    {
        return view('dashboard.student_dashboard');
    }
}
