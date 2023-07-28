<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    /** index page salary list */
    public function salary()
    {
        $salaryList =  Salary::all();
        return view('accounts.salary', compact('salaryList'));
    }

    public function update(Request $request, $id)
    {
        $newValue = $request->input('new_value');

        // You can add additional validation here if needed
        if (!in_array($newValue, ['Paid', 'Unpaid', 'Pending'])) {
            return response()->json(['error' => 'Invalid value'], 400);
        }

        // Update the data in the database
        $data = Salary::find($id);
        $data->status = $newValue;
        $data->save();

        return response()->json(['success' => true]);
    }

    /** salary add page */
    public function salaryAdd()
    {
        return view('accounts.add_salary');
    }

    /** salary save record */
    public function salarySave(Request $request)
    {
        $request->validate([
            'name'    => 'required|string',
            'amount'    => 'required|string',
            'status'    => 'required|string',
            'date_paid'    => 'required|string',

        ]);

        DB::beginTransaction();
        try {

            if (!empty($request->name)) {
                $salary = new salary;
                $salary->name   = $request->name;
                $salary->amount   = $request->amount;
                $salary->status   = $request->status;
                $salary->date   = $request->date_paid;
                $salary->save();

                Toastr::success('Has been add successfully :)', 'Success');
                DB::commit();
            }

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, Add new salary  :)', 'Error');
            return redirect()->back();
        }
    }

    /** view for edit salary */
    public function salaryEdit($id)
    {
        $salaryEdit = Salary::where('id', $id)->first();
        return view('accounts.edit_salary', compact('salaryEdit'));
    }

    /** update record */
    public function salaryUpdate(Request $request)
    {
        DB::beginTransaction();
        try {


            $updateRecord = [
                'name'    => $request->name,
                'amount'    => $request->amount,
                'status'    => $request->status,
                'date'    => $request->date_paid,

            ];
            Salary::where('id', $request->id)->update($updateRecord);

            Toastr::success('Has been update successfully :)', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, update salary  :)', 'Error');
            return redirect()->back();
        }
    }

    /** salary delete */
    public function salaryDelete(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->id)) {
                Salary::destroy($request->id);
                DB::commit();
                Toastr::success('salary deleted successfully :)', 'Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('salary deleted fail :)', 'Error');
            return redirect()->back();
        }
    }
}
