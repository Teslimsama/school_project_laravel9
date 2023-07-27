<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FeesCollection;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeCollectionController extends Controller
{
    /** index page Feescollection list */
    public function Feescollection()
    {
        $FeescollectionList = FeesCollection::all();
        return view('accounts.fee_collection', compact('FeescollectionList'));
    }

    

    /** Feescollection add page */
    public function FeescollectionAdd()
    {
        return view('accounts.add_fee_collection');
    }

    /** Feescollection save record */
    public function FeescollectionSave(Request $request)
    {
        $request->validate([
            'name'    => 'required|string',
            'amount'    => 'required|string',
            'fees_type'    => 'required|string',
            'status'    => 'required|string',
            'date_paid'    => 'required|string',
            
        ]);

        DB::beginTransaction();
        try {

            if (!empty($request->name)) {
                $Feescollection = new Feescollection;
                $Feescollection->name   = $request->name;
                $Feescollection->amount   = $request->amount;
                $Feescollection->status   = $request->status;
                $Feescollection->fees_type   = $request->fees_type;
                $Feescollection->date   = $request->date_paid;
                $Feescollection->save();

                Toastr::success('Has been add successfully :)', 'Success');
                DB::commit();
            }

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, Add new Feescollection  :)', 'Error');
            return redirect()->back();
        }
    }

    /** view for edit Feescollection */
    public function FeescollectionEdit($id)
    {
        $FeescollectionEdit = FeesCollection::where('id', $id)->first();
        return view('accounts.edit_fee_collection', compact('FeescollectionEdit'));
    }

    /** update record */
    public function FeescollectionUpdate(Request $request)
    {
        DB::beginTransaction();
        try {

            
            $updateRecord = [
                'name'    => $request->name,
                'amount'    => $request->amount,
                'status'    => $request->status,
                'fees_type'    => $request->fees_type,
                'date'    => $request->date_paid,
            
            ];
            FeesCollection::where('id', $request->id)->update($updateRecord);

            Toastr::success('Has been update successfully :)', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, update Feescollection  :)', 'Error');
            return redirect()->back();
        }
    }

    /** Feescollection delete */
    public function FeescollectionDelete(Request $request)
    {
        DB::beginTransaction();
        try {

            if (!empty($request->id)) {
                FeesCollection::destroy($request->id);
                DB::commit();
                Toastr::success('Feescollection deleted successfully :)', 'Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Feescollection deleted fail :)', 'Error');
            return redirect()->back();
        }
    }

}
