<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\department;
use App\Models\Library;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LibraryController extends Controller
{
    /** index page library list */
    public function library()
    {
        $libraryList = Library::all();
        return view('library.library', compact('libraryList'));
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
        if (!in_array($newValue, ['In Stock','Out Stock'])) {
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
        
        return response()->json([
            'department' => $department,
        ]);
    }
}