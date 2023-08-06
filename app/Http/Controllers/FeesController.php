<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fees;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class FeesController extends Controller
{
    public function Fees()
    {

        // $allowedRoles = ['Super Admin', 'Admin', 'Accounting', 'Student', 'Teachers'];
        $userRole = Session::get('role_name');
        if ($userRole === 'Super Admin' || $userRole === 'Admin' || $userRole === 'Accounting') {
            $feesList = Fees::all();
            return view('fees.fees', compact('feesList'));
        } elseif ($userRole === 'Student') {
            $studentclass = 1; 
            // $studentclass = Session::get('class');

            $studentresult = Fees::select('name', 'amount', 'class')
                ->where('class', $studentclass)
                ->distinct()
                ->get();
            return view('fees.fees', compact('studentresult'));
        }
    }
    public function addFees()
    {
        return view('fees.add_fees');
    }
    public function editFees($id)
    {
        $feesEdit = Fees::where('id', $id)->first();
        return view('fees.edit_fees', compact('feesEdit'));
    }
    public function saveFees(Request $request)
    {

        $request->validate([
            'name'    => 'required|string',
            'class'     => 'required|string',
            'amount'     => 'required|string',


        ]);

        DB::beginTransaction();
        try {


            if (!empty($request->name)) {
                $fees = new Fees;
                $fees->name   = $request->name;
                $fees->class    = $request->class;
                $fees->amount    = $request->amount;
                $fees->save();
                // dd($request);

                Toastr::success('Has been add successfully :)', 'Success');
                DB::commit();
            }

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, Add new fees  :)', 'Error');
            return redirect()->back();
        }
    }
    public function updateFees(Request $request)
    {
        DB::beginTransaction();
        try {
            //code...

            $updateRecord = [
                'name'    => $request->name,
                'class'     => $request->class,
                'amount'     => $request->amount,
            ];
            Fees::where('id', $request->id)->update($updateRecord);

            Toastr::success('Has been update successfully :)', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, update Fees  :)', 'Error');
            return redirect()->back();
        }
    }
    public function deleteFees(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->id)) {
                Fees::destroy($request->id);
                DB::commit();
                Toastr::success('Fees deleted successfully :)', 'Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Fees deleted fail :)', 'Error');
            return redirect()->back();
        }
    }
}
