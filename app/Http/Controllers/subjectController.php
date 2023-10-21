<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Timetable;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class subjectController extends Controller
{
    public function listSubject()
    {
        // $allowedRoles = ['Super Admin', 'Admin', 'Accounting', 'Student', 'Teachers'];
        $userRole = Session::get('role_name');
        if ($userRole === 'Super Admin' || $userRole === 'Admin') {
            $subjectList = Subject::all();
            return view('subject.subject', compact('subjectList'));
        } elseif ($userRole === 'Teachers') {
            $teacherId = Session::get('name');

            $result = Timetable::select('event_name', 'event_time', 'event_date', 'class')
                ->where('teacher_name', $teacherId)
                ->distinct()
                ->get();
            return view('subject.subject', compact('result'));
        } elseif ($userRole === 'Student') {
            $studentclass = Session::get('class');

            $studentresult = Timetable::select('event_name', 'event_time', 'event_date', 'class')
                ->where('class', $studentclass)
                ->distinct()
                ->get();
            return view('subject.subject', compact('studentresult'));
        }

        // return view('subject.subject', compact('result', 'subjectList'));
    }
    public function subjectIndex()
    {
        return view('subject.add_subject');
    }
    public function saveSubject(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|unique:subjects,name',
        ]);

        DB::beginTransaction();
        try {
            if (!empty($request->name)) {
                $subject = new Subject;
                $subject->name   = $request->name;
                $subject->save();

                Toastr::success('Has been added successfully :)', 'Success');
                DB::commit();
            }

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, Add new subject  :(', 'Error' . $e->getMessage());
            return redirect()->back();
        }
    }
    public function editsubject($id)
    {
        $subjectEdit = Subject::where('id', $id)->first();
        return view('subject.edit_subject', compact('subjectEdit'));
    }
    /** update record */
    public function subjectUpdate(Request $request)
    {
        $updateRecord = [
            'name'    => $request->name,
        ];
        DB::beginTransaction();
        try {
            Subject::where('id', $request->id)->update($updateRecord);

            Toastr::success('Has been update successfully :)', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, update subject  :)', 'Error');
            return redirect()->back();
        }
    }
    public function subjectDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            if (!empty($request->id)) {
                Subject::destroy($request->id);

                DB::commit();
                Toastr::success('subject deleted successfully :)', 'Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('subject deleted fail :)', 'Error');
            return redirect()->back();
        }
    }
}
