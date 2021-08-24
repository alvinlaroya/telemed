<?php

namespace App\Http\Controllers\Medical;

use App\Leave;
use App\Doctor;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Rules\Emails\CommaSeparatedEmails;
use App\Rules\Phones\CommaSeparatedPhones;
use App\Http\Controllers\Controller;

class DoctorsController extends Controller
{
    /**
     * Display list of doctors.
     * 
     */
    public function index()
    {
    	$doctors = Doctor::latest()->paginate(10);

    	return view('medical.doctors', compact('doctors'));
    }

    /**
     * Display list of doctor schedules.
     * 
     * @param  \App\Doctor  $doctor
     */
    public function schedule(Doctor $doctor)
    {
    	$leaves = Leave::get();
		$types = Schedule::$types;

    	return view('medical.schedule', compact('doctor', 'leaves', 'types'));
    }

    /**
     * Show profile of specified doctor.
     * 
     * @param  \App\Doctor  $doctor
     */
    public function profile(Doctor $doctor)
    {
        return view('medical.profile', compact('doctor'));
    }

    /**
     * Update data of specified doctor in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     */
    public function update(Request $request, Doctor $doctor)
    {
        $rules = array(
            'picture' => 'file|max:1000|mimes:jpeg,png|dimensions:min_width=235,min_height=235',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($doctor->user_id),
            ],
            'mobile' => 'required',
            'specializations' => 'required',
        );
        // $rules = array(
        //     'consultation_fee' => 'required',
        // );
        if($request->filled('password')){
            $rules['password'] = 'confirmed';
        }
        if($request->filled('consultation_duration')){
            $rules['consultation_duration'] = array(
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    if ($value % 5 !== 0) {
                        $fail('Consultation duration must be divisible by 5.');
                    }
                },
            );
        }
        if($request->filled('email_to_receive_notifications')){
            $rules['email_to_receive_notifications'] = [new CommaSeparatedEmails];
        }
        if($request->filled('mobile_to_receive_notifications')){
            $rules['mobile_to_receive_notifications'] = [new CommaSeparatedPhones];
        }
        $data = $request->validate($rules);

        $this->save($request, $doctor);

        return redirect()->back()
                        ->with('success', 'Successfully updated doctor!');
    }

    /**
     * Save doctor details from storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     */
    private function save($request, $doctor)
    {
        $doctor->fill($request->all());
        if($request->inputPicture){
            $doctor->addMediaFromBase64($request->inputPicture)
            ->usingFileName("avatar-{$doctor->id}.png")
            ->usingName($doctor->name)
            ->toMediaCollection('avatar');
        }
        $user = $doctor->user;
        $user->name = $doctor->name;
        $user->email = $request->email;
        $user->password = $request->filled('password') ? Hash::make($request->password) : $user->password;
        $user->save();
        if($request->filled('specializations') && count($request->specializations) > 0){
            $doctor->specializations()->sync($request->specializations);
        }else{
            $doctor->specializations()->detach();
        }
        if($request->filled('hmos') && count($request->hmos) > 0){
            $doctor->hmos()->sync($request->hmos);
        }else{
            $doctor->hmos()->detach();
        }
        $doctor->save();
    }

}
