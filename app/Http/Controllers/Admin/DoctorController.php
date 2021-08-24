<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Rules\Emails\CommaSeparatedEmails;
use App\Rules\Phones\CommaSeparatedPhones;

class DoctorController extends Controller
{
    /**
     * Display a listing of doctors.
     */
    public function index()
    {
        $doctors = Doctor::latest()->paginate(10);

        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new doctor.
     */
    public function create()
    {
        return view('admin.doctors.create');
    }

    /**
     * Store a newly created doctor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $rules = array(
            'picture' => 'file|max:1000|mimes:jpeg,png|dimensions:min_width=235,min_height=235',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            // 'email' => 'required|email|unique:doctors',
            'email' => 'required|email|unique:doctors,email,NULL,id,deleted_at,NULL',
            'mobile' => 'required',
            'password' => 'required|string|min:5|confirmed',
            'specializations' => 'required',
        );
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

        $checkDeletedDoctor = Doctor::withTrashed()->where('email', $request->email)
                                                    ->whereNotNull('deleted_at')
                                                    ->first();
        if(!$checkDeletedDoctor){
            $rules['email'] = 'required|email|unique:users';
            $data = $request->validate($rules);
        }

        $doctor = new Doctor;
        $this->save($request, $doctor, 'create');

        return redirect()->route('admin.doctors.index')
                        ->with('success', 'Successfully added doctor!');
    }

    /**
     * Display the specified doctor.
     *
     * @param  \App\Doctor  $doctor
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified doctor.
     *
     * @param  \App\Doctor  $doctor
     */
    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified doctor in storage.
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
            // 'email' => [
            //     'required',
            //     'email',
            //     Rule::unique('users')->ignore($doctor->user_id),
            // ],
            'email' => 'required|email|unique:doctors,email,'.$doctor->id.',id,deleted_at,NULL',
            'mobile' => 'required',
            'specializations' => 'required',
        );
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

        $checkDeletedDoctor = Doctor::withTrashed()->where('email', $request->email)
                                                    ->whereNotNull('deleted_at')
                                                    ->first();
        if(!$checkDeletedDoctor){
            $rules['email'] = 'required|email|unique:users,email,'.$doctor->user_id;
            $data = $request->validate($rules);
        }

        $this->save($request, $doctor, 'update');

        return redirect()->back()
                        ->with('success', 'Successfully updated doctor!');
    }

    /**
     * Remove the specified doctor from storage.
     *
     * @param  \App\Doctor  $doctor
     */
    public function destroy(Doctor $doctor)
    {
        if(count($doctor->secretaries) > 0){
            return redirect()->back()
                        ->with('error', 'Unable to delete doctor, delete secretaries first!');
        }

        $doctor->delete();

        return redirect()->back()
                        ->with('success', 'Successfully deleted!');
    }

    /**
     * Save the specified doctor data in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @param  mixed  $from
     */
    private function save($request, $doctor, $from = null)
    {
        $request->merge(array('status' => $request->status == 1 ? true : false));
        $doctor->fill($request->all());
        if($request->inputPicture){
            $doctor->addMediaFromBase64($request->inputPicture)
            ->usingFileName("avatar-{$doctor->id}.png")
            ->usingName($doctor->name)
            ->toMediaCollection('avatar');
        }
        if($from == 'create') {
            $user = new User;
            $user->name = $doctor->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = User::DOCTOR;
            $user->status = $request->status;
            $user->save();
            $doctor->user_id = $user->id;
        } else if($from == 'update') {
            $user = $doctor->user;
            $user->name = $doctor->name;
            $user->email = $request->email;
            $user->password = $request->filled('password') ? Hash::make($request->password) : $user->password;
            $user->status = $request->status;
            $user->save();
        }
        $doctor->save();
        if($from == 'create') {
            if($request->filled('specializations') && count($request->specializations) > 0){
                $doctor->specializations()->attach($request->specializations);
            }
            if($request->filled('hmos') && count($request->hmos) > 0){
                $doctor->hmos()->attach($request->hmos);
            }
        } else if($from == 'update') {
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
        }
    }
}
