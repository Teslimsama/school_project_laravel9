<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class subjectController extends Controller
{
    public function listSubject()
    {
        $subjectList = Subject::all();
        return view('subject.subject', compact('subjectList'));
    }
    public function subjectIndex()
    {
        return view('subject.add_subject');
    }
    public function saveSubject(Request $request)
    {
        $request->validate([
            'name'    => 'required|string',
            'class'     => 'required|int',
        ]);

        DB::beginTransaction();
        try {
            if (!empty($request->name)) {
                $subject = new Subject;
                $subject->name   = $request->name;
                $subject->class    = $request->class;
                $subject->save();

                Toastr::success('Has been added successfully :)', 'Success');
                DB::commit();
            }

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, Add new subject  :(', 'Error');
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
            'class'     => $request->class,
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
