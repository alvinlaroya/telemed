<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SmsNotifSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SmsNotificationsController extends Controller
{
    /**
     * Display list for sms setting.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function smsSettings(Request $request)
    {
        $cogs = SmsNotifSettings::get()->groupBy('group');

        return view('admin.sms-notifications.index', compact('cogs'));
    }

    /**
     * Update sms setting.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function smsSettingsUpdate(Request $request)
    {
        // Put to false
        DB::table('smsnotif_settings')
            ->whereNotIn('name', Arr::flatten(array_keys($request->settings)))
            ->update(array('value' => false));

        // Put to true
        DB::table('smsnotif_settings')
            ->whereIn('name', Arr::flatten(array_keys($request->settings)))
            ->update(array('value' => true));

        return redirect()
                ->back()
                ->with('success', 'SMS settings updated successfully!');
    }
}
