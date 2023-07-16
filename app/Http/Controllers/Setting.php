<?php

namespace App\Http\Controllers;

use App\Models\Seosettings;
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
                $websiteName = $request->name;
                $upload_file2 = "favicon" . time() . '.' . $request->favicon->extension();
                $upload_file = "logo" . time() . '.' . $request->logo->extension();
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
    public function Address(Request $request)
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
    // public function Localization(){
    //     $settingsDetails = Settings::where('id', 1)->first();
    //     return view('setting.localization', compact('settingsDetails'));
    //     // return view('setting.localization');
    // }
    public function EmailSettings()
    {
        return view('setting.email');
    }
    public function Payment()
    {
        return view('setting.payment');
    }
    public function SocialLinks()
    {
        $settingsDetails = Settings::where('id', 1)->first();
        return view('setting.social_links', compact('settingsDetails'));
        // return view('setting.social_links');
    }
    public function UpdateSocialLinks(Request $request)
    {
        $request->validate([
            'facebook'    => 'required|string',
            'twitter'     => 'required|string',
            'youtube'        => 'required|string',
            'linkedin' => 'required|string',
            // 'zip'          => 'required',
            // 'country'   => 'required|string',
        ]);

        DB::beginTransaction();
        try {


            if (!empty($request->facebook)) {
                $settings = new Settings;
                $settings = Settings::find(1);
                $settings->facebook   = $request->facebook;
                $settings->twitter    = $request->twitter;
                $settings->youtube       = $request->youtube;
                $settings->linkedin = $request->linkedin;
                // $settings->country         = $request->country;
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
    public function SocialLogin()
    {
        return view('setting.social_login');
    }
    public function SeoSettings()
    {
        $SeosettingsDetails = Seosettings::where('id', 1)->first();
        return view('setting.seo_settings', compact('SeosettingsDetails'));
    }
    public function UpdateSeoSettings(Request $request)
    {
        $request->validate([
            'title'    => 'required|string',
            'services'     => 'required|string',
            'description'        => 'required|string',

        ]);
        DB::beginTransaction();
        try {


            if (!empty($request->title)) {
                $seosettings = new Seosettings;
                // echo $request->title;
                $seosettings = Seosettings::find(1);
                $seosettings->meta_title   = $request->title;
                $seosettings->meta_keywords    = $request->services;
                $seosettings->meta_description       = $request->description;

                $seosettings->save();

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
    public function OtherSettings()
    {
        $SeosettingsDetails = Seosettings::where('id', 1)->first();
        return view('setting.other_settings', compact('SeosettingsDetails'));
    }
    public function OtherSettingsUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            // dd($request->input());
            if ($request->has('googleanalytics')) {
                // dd($request->input());
                $seosettings = new Seosettings;
                $seosettings = Seosettings::find(1);
                $seosettings->google_analytics   = $request->googleanalytics;
                

                $seosettings->save();

                Toastr::success('Has been Updated successfully :)', 'Success');
                DB::commit();
            }
            if ($request->has('googleadsensecode')) {
                // dd($request->input());
                $seosettings = new Seosettings;
                $seosettings = Seosettings::find(1);
                $seosettings->google_adsense_code   = $request->googleadsensecode;


                $seosettings->save();

                Toastr::success('Has been Updated successfully :)', 'Success');
                DB::commit();
            }
            if ($request->has('facebookmessenger')) {
                // dd($request->input());
                $seosettings = new Seosettings;
                $seosettings = Seosettings::find(1);
                $seosettings->facebook_messenger   = $request->facebookmessenger;


                $seosettings->save();

                Toastr::success('Has been Updated successfully :)', 'Success');
                DB::commit();
            }
            if ($request->has('facebookpixel')) {
                // dd($request->input());
                $seosettings = new Seosettings;
                $seosettings = Seosettings::find(1);
                $seosettings->facebook_pixel   = $request->facebookpixel;


                $seosettings->save();

                Toastr::success('Has been Updated successfully :)', 'Success');
                DB::commit();
            }
            if ($request->has('googlerecaptcha_1')) {
                // dd($request->input());
                $seosettings = new Seosettings;
                $seosettings = Seosettings::find(1);
                $seosettings->google_recaptcha_1   = $request->googlerecaptcha_1;
                $seosettings->google_recaptcha_2   = $request->googlerecaptcha_2;


                $seosettings->save();

                Toastr::success('Has been Updated successfully :)', 'Success');
                DB::commit();
            }
            if ($request->has('cookiesagreement')) {
                // dd($request->input());
                $seosettings = new Seosettings;
                $seosettings = Seosettings::find(1);
                $seosettings->cookies_agreement   = $request->cookiesagreement;


                $seosettings->save();

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
