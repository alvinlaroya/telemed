<?php

namespace App\Http\Controllers\Center;

use App\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Rules\Emails\CommaSeparatedEmails;
use App\Rules\Phones\CommaSeparatedPhones;

class SettingController extends Controller
{
    /**
     * Display list of settings.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
    	$user = $request->user();
        $center = $user->center();

        return view('center.settings', compact('center'));
    }

    /**
     * Update account.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function updateAccount(Request $request)
    {
        $rules = array();
        if($request->filled('password')){
            $rules['password'] = 'string|min:5|confirmed';
        }
        $data = $request->validate($rules);

        $user = $request->user();
        $user->password = $request->filled('password') ? Hash::make($request->password) : $user->password;
        $user->save();

        return redirect()->back()
                        ->with('success', 'Successfully updated account settings!');
    }

    /**
     * Update settings from storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request)
    {
        $rules = [];
        if(count((array) $request->centers) > 0){
            foreach ($request->centers as $key => $value) {
                if ($request->filled('centers.'.$key.'.emails')) {
                    $rules['centers.'.$key.'.emails'] = [
                        function($attribute, $value, $fail){
                            $values = explode(',', $value);
                            foreach($values as $email){
                                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                    $fail('Email to receive notifications contains invalid email addresses.');
                                }
                            }
                        }
                    ];
                }
            }
        }
        if(count((array) $request->centers) > 0){
            foreach ($request->centers as $key => $value) {
                if ($request->filled('centers.'.$key.'.mobiles')) {
                    $rules['centers.'.$key.'.mobiles'] = [
                        function($attribute, $value, $fail){
                            $values = explode(',', $value);
                            foreach($values as $mobile){
                                if(!preg_match('/(09)[0-9]{9}$|(\+63)[0-9]{10}$/', $mobile)){
                                    $fail('Mobile to receive notifications contains invalid mobile numbers.');
                                }
                            }
                        }
                    ];
                }
            }
        }
        $data = $request->validate($rules);

        if(count((array) $request->centers) > 0){
            foreach($request->centers as $key => $value){
                $center = ServiceCategory::find($key);
                if($center){
                    $center->email_to_receive_notifications = $value['emails'];
                    $center->mobile_to_receive_notifications = $value['mobiles'];
                    $center->save();
                }
            }
        }

        return redirect()->back()
                        ->with('success', 'Successfully updated settings!');
    }
}
