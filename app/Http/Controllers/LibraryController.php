<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\department;
use App\Models\Library;
use App\Models\Teacher;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class LibraryController extends Controller
{
    /** index page library list */
    public function library()
    {
        $userRole = Session::get('role_name');
        if ($userRole === 'Super Admin' || $userRole === 'Admin') {

            $libraryList = Library::all();
            
            return view('library.library', compact('libraryList'));
        } elseif ($userRole === 'Teachers') {
            $teacherId = Session::get('id');
            // Find the teacher by ID
            $teacher = Teacher::with('libraries')->find($teacherId);
            if ($teacher) {
                // Fetch the classes taught by the teacher along with the books used in each class
                $classesWithBooks = $teacher->libraries;
                
                return view('library.library', compact('teacher', 'classesWithBooks'));
            }
            return view('library.library', compact('teacher'));
        } elseif ($userRole === 'Student') {
            $studentclass = Session::get('class');
            // $studentclass = 4;

            $studentresult = Library::select('book_name', 'type')
                ->where('class_id', $studentclass)
                ->distinct()
                ->get();
            return view('library.library', compact('studentresult'));
        }
    }
    /** library add page */
    public function libraryAdd()
    {
        return view('library.add_library');
    }
    public function update(Request $request, $id)
    {
        $newValue = $request->input('new_value');

        // You can add additional validation here if needed
        if (!in_array($newValue, ['In Stock', 'Out Stock'])) {
            return response()->json(['error' => 'Invalid value'], 400);
        }

        // Update the data in the database
        $data = Library::find($id);
        $data->status = $newValue;
        $data->save();

        return response()->json(['success' => true]);
    }
    /** library save record */
    public function librarySave(Request $request)
    {
        $request->validate([
            'book_name'    => 'required|string',
            'class'    => 'required|string',
            'department'    => 'required|string',
            'status'    => 'required|string',
            'type'    => 'required|string',
            'language'    => 'required|string',
            'teacher'    => 'required|string',

        ]);

        DB::beginTransaction();
        try {
            if (!empty($request->book_name)) {
                $library = new library;
                $library->book_name   = $request->book_name;
                $library->class   = $request->class;
                $library->department   = $request->department;
                $library->status   = $request->status;
                $library->type   = $request->type;
                $library->language   = $request->language;
                $library->teacher_id   = $request->teacher;
                $library->save();
                // dd($request->date);

                Toastr::success('Has been add successfully :)', 'Success');
                DB::commit();
            }

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, Add new library  :)', 'Error');
            return redirect()->back();
        }
    }

    /** view for edit library */
    public function libraryEdit($id)
    {
        $libraryEdit = library::where('id', $id)->first();
        return view('library.edit_library', compact('libraryEdit'));
    }

    /** update record */
    public function libraryUpdate(Request $request)
    {
        DB::beginTransaction();
        try {

            $updateRecord = [
                'book_name'   => $request->book_name,
                'class'   => $request->class,
                'status'   => $request->status,
                'type'   => $request->type,
                'department'   => $request->department,
                'language'   => $request->language,
                'teacher_id'   => $request->teacher,
            ];
            library::where('id', $request->id)->update($updateRecord);

            Toastr::success('Has been update successfully :)', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, update library  :)', 'Error');
            return redirect()->back();
        }
    }

    /** library delete */
    public function libraryDelete(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->id)) {
                library::destroy($request->id);
                DB::commit();
                Toastr::success('library deleted successfully :)', 'Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('library deleted fail :)', 'Error');
            return redirect()->back();
        }
    }
    public function getdepartmentClasses()
    {
        $department = department::pluck('name', 'id');
        $teacher = Teacher::pluck('full_name', 'id');

        return response()->json([
            'department' => $department,
            'teacher' => $teacher,
        ]);
    }
}
