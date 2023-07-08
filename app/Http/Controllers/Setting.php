<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Settings;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class Setting extends Controller
{
    // index page setting
    public function index()
    {

        $settingsDetails = Settings::where('id', 1)->first();
        return view('setting.settings', compact('settingsDetails'));
        // return view('setting.settings');
    }
    public function WebsiteBasicDetailsUpdate(Request $request)
    {

        DB::beginTransaction();
        try {


            if (!empty($request->favicon && $request->logo)) {
                unlink(storage_path('app/public/photos/' . $request->image_hidden1));
                unlink(storage_path('app/public/photos/' . $request->image_hidden2));
                $websiteName= $request->name;
                $upload_file2 = "favicon" . time() . '.' . $request->favicon->extension();
                $upload_file = "logo".time() . '.' . $request->logo->extension();
                $request->logo->move(storage_path('app/public/photos/'), $upload_file);
                $request->favicon->move(storage_path('app/public/photos/'), $upload_file2);
            } else {
                $upload_file = $request->image_hidden1;
                $upload_file2 = $request->image_hidden2;
                $websiteName = $request->name;
            }

            $updateRecord = [
                'name' => $websiteName,
                'logo' => $upload_file,
                'favicon' => $upload_file2,
            ];
            Settings::where('id', 1)->update($updateRecord);

            Toastr::success('Has been update successfully :)', 'Success');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, update Website Details  :)', 'Error');
        }
    }
    // update address
    public function address(Request $request)
    {
        $request->validate([
            'address1'    => 'required|string',
            'address2'     => 'required|string',
            'city'        => 'required|string',
            'state' => 'required|string',
            'zip'          => 'required',
            'country'   => 'required|string',
        ]);

        DB::beginTransaction();
        try {


            if (!empty($request->address1)) {
                $settings = new Settings;
                $settings = Settings::find(1);
                $settings->address1   = $request->address1;
                $settings->address2    = $request->address2;
                $settings->city       = $request->city;
                $settings->state = $request->state;
                $settings->country         = $request->country;
                $settings->save();

                Toastr::success('Has been Updated successfully :)', 'Success');
                DB::commit();
            }

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('fail, Update   :)', 'Error');
            return redirect()->back();
        }
    }
}
