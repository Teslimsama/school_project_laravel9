<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Subject;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    /** index page exam list */
    public function exam()
    {
        $examList = Exam::all();
        return view('exam.exam', compact('examList'));
    }

    /** exam add page */
    public function examAdd()
    {
        return view('exam.add_exam');
    }

    /** exam save record */
    public function examSave(Request $request)
    {
        $request->validate([
            'subject'    => 'required|string',
            'class'    => 'required|string',
            'start_time'    => 'required|string',
            'end_time'    => 'required|string',
            'date'    => 'required|string',

        ]);

        DB::beginTransaction();
        try {
            if (!empty($request->subject)) {
                $exam = new Exam;
                $exam->subject   = $request->subject;
                $exam->class   = $request->class;
                $exam->start_time   = $request->start_time;
                $exam->end_time   = $request->end_time;
                $exam->date   = $request->date;
                $exam->save();
                // dd($request->date);

                Toastr::success('Has been add successfully :)', 'Success');
                DB::commit();
            }

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, Add new exam  :)', 'Error');
            return redirect()->back();
        }
    }

    /** view for edit exam */
    public function examEdit($id)
    {
        $examEdit = Exam::where('id', $id)->first();
        return view('exam.edit_exam', compact('examEdit'));
    }

    /** update record */
    public function examUpdate(Request $request)
    {
        DB::beginTransaction();
        try {

            $updateRecord = [
                'subject'   => $request->subject,
                'class'   => $request->class,
                'end_time'   => $request->end_time,
                'date'   => $request->date,
                'start_time'   => $request->start_time,
            ];
            Exam::where('id', $request->id)->update($updateRecord);

            Toastr::success('Has been update successfully :)', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, update exam  :)', 'Error');
            return redirect()->back();
        }
    }

    /** exam delete */
    public function examDelete(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->id)) {
                Exam::destroy($request->id);
                DB::commit();
                Toastr::success('exam deleted successfully :)', 'Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('exam deleted fail :)', 'Error');
            return redirect()->back();
        }
    }
    public function getSubjectsClasses()
    {
        $subjects = Subject::pluck('name', 'id');
        $classes = Subject::pluck('class', 'id');
        return response()->json([
            'subjects' => $subjects,
            'classes' => $classes,
        ]);
    }
}
