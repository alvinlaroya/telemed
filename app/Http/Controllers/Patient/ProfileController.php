<?php

namespace App\Http\Controllers\Patient;

use App\Patient;
use App\UserAddress;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Book an appointment for a specified doctor.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function updateProfile(Request $request)
    {
        //$birthdate = Carbon::createFromDate(
        //    $request->birthdate_year,
          //  $request->birthdate_month,
            //$request->birthdate_day
        //);

        $selectedBirthDay = new \DateTime($request->birthdate_day . ' ' . $request->birthdate_month . ' ' . $request->birthdate_year);

        Patient::where('user_id', auth()->user()->id)
        ->update([
            'middle_name'        => $request->middle_name,
            'province_id'   => $request->province,
            'city_id'    => $request->city,
            'house_number'       => $request->houseNumber,
            'street'       => $request->street,
            'barangay'       => $request->barangay,
            'zipcode'       => $request->zipcode,
            'gender'       => $request->gender,
            'birthdate'       => $selectedBirthDay
        ]);

        UserAddress::create([
            'user_id'        => auth()->user()->id,
            'province'   => $request->province,
            'city'    => $request->city,
            'house_number'       => $request->houseNumber,
            'street'       => $request->street,
            'barangay'       => $request->barangay,
            'zip_code'       => $request->zipcode,
        ]);

               
        
        return redirect()->route('patient.index')
                    ->with('step_success', true)
                    ->with('success', 'Successfully save appointment!');
    }
}
