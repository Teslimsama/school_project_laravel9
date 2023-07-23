<?php

namespace App\Http\Controllers;

use App\Models\department;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function listDepartment()
    {
        $departmentList = department::all();
        return view('department.department', compact('departmentList'));
    }
    /** index page department */
    public function indexDepartment()
    {
        return view('department.add-department');
    }
    public function saveDepartment(Request $request)
    {
        $request->validate([
            'name'    => 'required|string',
            'hod'     => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            if (!empty($request->name)) {
                $department = new department;
                $department->name   = $request->name;
                $department->hod    = $request->hod;
                $department->save();

                Toastr::success('Has been added successfully :)', 'Success');
                DB::commit();
            }

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, Add new department  :(', 'Error');
            return redirect()->back();
        }
    }
    
    /** edit record */
    public function editDepartment($id)
    {
        $departmentEdit = department::where('id', $id)->first();
        return view('department.edit-department', compact('departmentEdit'));
    }
    /** update record */
    public function departmentUpdate(Request $request)
    {
        $updateRecord = [
            'name'    => $request->name,
            'hod'     => $request->hod,
        ];
        DB::beginTransaction();
        try {
            department::where('id', $request->id)->update($updateRecord);

            Toastr::success('Has been update successfully :)', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, update department  :)', 'Error');
            return redirect()->back();
        }
    }
    public function deleteDepartment(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->id)) {
                department::destroy($request->id);
                
                DB::commit();
                Toastr::success('department deleted successfully :)', 'Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('department deleted fail :)', 'Error');
            return redirect()->back();
        }
    }
}
