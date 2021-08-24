<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\Emails\CommaSeparatedEmails;
use App\Rules\Phones\CommaSeparatedPhones;

class SettingController extends Controller
{
    /**
     * Display a listing of the settings.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new setting.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created setting in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified setting.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified setting.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function edit(Request $request)
    {
        $settings = Setting::get();
        return view('admin.settings.edit', compact('settings'));
    }

    /**
     * Update the specified setting in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
        $rules = array();
        if($request->filled('settings.admin_emails')){
            $rules['settings.admin_emails'] = [
                function($attribute, $value, $fail){
                    $values = explode(',', $value);
                    foreach($values as $email){
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $fail('Admin emails contains invalid email addresses.');
                        }
                    }
                }
            ];
        }
        if($request->filled('settings.email_to_receive_notifications')){
            $rules['settings.email_to_receive_notifications'] = [
                function($attribute, $value, $fail){
                    $values = explode(',', $value);
                    foreach($values as $email){
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $fail('Email to Receive Notifications contains invalid email addresses.');
                        }
                    }
                }
            ];
        }
        if($request->filled('settings.mobile_to_receive_notifications')){
            $rules['settings.mobile_to_receive_notifications'] = [
                function($attribute, $value, $fail){
                    $values = explode(',', $value);
                    foreach($values as $mobile){
                        if(!preg_match('/(09)[0-9]{9}$|(\+63)[0-9]{10}$/', $mobile)){
                            $fail('Mobile to Receive Notifications contains invalid mobile numbers.');
                        }
                    }
                }
            ];
        }
        $data = $request->validate($rules);

        $modifySettingsRequest = array_merge($request->settings, array(
            'service_maintenance_mode' => $request->filled('settings.service_maintenance_mode') ? 1 : 0,
            'doctor_maintenance_mode' => $request->filled('settings.doctor_maintenance_mode') ? 1 : 0,
        ));
        $request->merge(array('settings' => $modifySettingsRequest));
        $settingsFields = $request->filled('settings') ? $request->settings : array();
        if(count($settingsFields) > 0){
            foreach($settingsFields as $key => $field){
                $setting = Setting::whereName($key)->first();
                if($setting){
                    $setting->value = $field;
                    $setting->save();
                }
            }
        }
        return redirect()->back()
                        ->with('success', 'Successfully updated settings!');
    }

    /**
     * Remove the specified setting from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        //
    }
}
