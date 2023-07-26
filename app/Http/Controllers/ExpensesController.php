<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Expenses;
// use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /** index page expenses list */
    public function expenses()
    {
        $expensesList = Expenses::all();
        return view('accounts.expenses', compact('expensesList'));
    }

    /** expenses add page */
    public function expensesAdd()
    {
        return view('accounts.add_expenses');
    }

    /** expenses save record */
    public function expensesSave(Request $request)
    {
        $request->validate([
            'item_name'    => 'required|string',
            'item_quantity'    => 'required|string',
            'amount'    => 'required|string',
            'purchase_source'    => 'required|string',
            'purchase_by'    => 'required|string',
            'purchase_date'    => 'required|string',
            
        ]);

        DB::beginTransaction();
        try {
            if (!empty($request->item_name)) {
                $expenses = new Expenses;
                $expenses->item_name   = $request->item_name;
                $expenses->item_quantity   = $request->item_quantity;
                $expenses->amount   = $request->amount;
                $expenses->purchase_source   = $request->purchase_source;
                $expenses->purchase_date   = $request->purchase_date;
                $expenses->purchase_by   = $request->purchase_by;
                $expenses->save();
                // dd($request->purchase_by);

                Toastr::success('Has been add successfully :)', 'Success');
                DB::commit();
            }

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, Add new expenses  :)', 'Error');
            return redirect()->back();
        }
    }

    /** view for edit expenses */
    public function expensesEdit($id)
    {
        $expensesEdit = Expenses::where('id', $id)->first();
        return view('accounts.edit_expenses', compact('expensesEdit'));
    }

    /** update record */
    public function expensesUpdate(Request $request)
    {
        DB::beginTransaction();
        try {

            $updateRecord = [
                'item_name'   => $request->item_name ,
                'item_quantity'   => $request->item_quantity,
                'purchase_source'   => $request->purchase_source,
                'purchase_date'   => $request->purchase_date,
                'purchase_by'   => $request->purchase_by,
                'amount'   => $request->amount,
            ];
            Expenses::where('id', $request->id)->update($updateRecord);

            Toastr::success('Has been update successfully :)', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, update expenses  :)', 'Error');
            return redirect()->back();
        }
    }

    /** expenses delete */
    public function expensesDelete(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->id)) {
                Expenses::destroy($request->id);
                DB::commit();
                Toastr::success('expenses deleted successfully :)', 'Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('expenses deleted fail :)', 'Error');
            return redirect()->back();
        }
    }

    
}
