<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
   public function setting_update( Request $request){
   
        if ($request->isMethod('get')) {
          $setting = Setting::orderBy('setting_id', 'DESC')->first();
          // echo "<pre>"; print_r($setting); die;
                return view('setting.setting', compact('setting'));
            
        } else {
      
          $record = Setting::orderBy('setting_id', 'DESC')->first();
            if(!empty($record)){
              $setting_data = Setting::find($record->setting_id);
            }else{
              $setting_data = new Setting;
            }
            
            if ($request->logo) {
                $file_upload_path = public_path('uploads/logo/' . date('Ym') . '');
                if (!empty($setting_data->logo)) {
    
                    if (\File::exists(public_path($setting_data->logo))) {
                        \File::delete(public_path($setting_data->logo));
                    }
                }
    
                $imageName = date('Ymd-his-') . rand(100, 999999) . '.' . $request->logo->extension();
                $logo_name = 'uploads/logo/' . date('Ym') . '' . '/' . $imageName;
                $request->logo->move($file_upload_path, $imageName);	
                $setting_data->logo = $logo_name;
            }
            
            if ($request->favicon) {
                $file_upload_path = public_path('uploads/favicon/' . date('Ym') . '');
                if (!empty($setting_data->favicon)) {
    
                    if (\File::exists(public_path($setting_data->favicon))) {
                        \File::delete(public_path($setting_data->favicon));
                    }
                }
    
                $imageName = date('Ymd-his-') . rand(100, 999999) . '.' . $request->favicon->extension();
                $favicon_name = 'uploads/favicon/' . date('Ym') . '' . '/' . $imageName;
                $request->favicon->move($file_upload_path, $imageName);	
                $setting_data->favicon = $favicon_name;
            }
            
            $setting_data->website_name = $request->website_name;
            $setting_data->contact_details = $request->contact_details;
            $setting_data->phone = $request->phone;
            $setting_data->description = $request->description;
            $setting_data->creation_datetime = date('Y-m-d h:i:s');
            $setting_data->address = $request->address;
            $setting_data->email = $request->email;
            // echo "<pre>"; print_r($setting_data); die;
            if (!empty($setting_data)) {
                $setting_data->save();
            }
            $message = "Record Saved Succesfully";
            return redirect()->route('setting_update')->with('success', $message);
        }
  
   }
}
