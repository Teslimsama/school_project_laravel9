<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\Event;
use App\Models\Student;
use App\Models\FeesCollection;
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
    public function index()
    {
        //ADMIN DASHBOARD AREA GRAPH

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


        //ADMIN DASHBOARD BAR CHART GRAPH

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
        //ADMIN DASHBOARD COUNT
        $studentCount = Student::count();
        $departmentCount = department::count();
        $teacherCount = Teacher::count();
        $revenueCount = FeesCollection::sum('amount');


        return view('dashboard.home', [
            'months' => $months,
            'maleStudentCounts' => $maleStudentCounts,
            'femaleStudentCounts' => $femaleStudentCounts,

            'year' => $year,
            'teacherCounts' => $teacherCounts,
            'studentCounts' => $studentCounts,

            'studentCount' => $studentCount,
            'revenueCount' => $revenueCount,
            'teacherCount' => $teacherCount,
            'departmentCount' => $departmentCount,
        ]);
    }
    public function getEvent()
    {
        if (request()->ajax()) {
            if (request()->ajax()) {
                $events = Event::select('id', 'title', 'start', 'end', 'category')->get();
                return response()->json($events);
            }
        }
        return response()->json("hi");
        return view('dashboard.home');
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
