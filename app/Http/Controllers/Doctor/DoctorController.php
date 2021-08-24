<?php

namespace App\Http\Controllers\Doctor;

use App\City;
use App\User;
use App\Doctor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Rules\Emails\CommaSeparatedEmails;
use App\Rules\Phones\CommaSeparatedPhones;
use App\UserAddress;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     */
    public function edit(Doctor $doctor, $type)
    {
        $doctorLogged = auth()->user()->isSecretary() ? auth()->user()->assignedDoctor : auth()->user()->doctor;
        
        if($doctorLogged->id != $doctor->id){
            abort('403');
        }
        
        if($type == 'edit'){
            // abort('403');
        }

        $cities = City::with(['province'])->orderBy('name')->get();
        
        return view('doctor.profile', compact('doctor', 'type', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     */
    public function update(Request $request, Doctor $doctor, $type)
    {
        $rules = array();
        if($type == 'settings'){
            $rules = array(
                // 'consultation_fee' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($doctor->user_id),
                ],
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
        }elseif($type == 'edit'){
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
                'cities.*' => 'required|numeric|distinct'
            );

            // ADDRESS
            if(request()->has('cities')) {
                foreach(request('cities') as $cityId) {
                    $city = City::with('province')->where('city_id', $cityId)->first();

                    if($city) {
                        if(isset($doctor->address)) {
                            $doctor->address->delete();
                        }

                        UserAddress::create([
                            'user_id' => $doctor->user->id,
                            'province' => $city->province->province_id,
                            'city' => $city->city_id
                        ]);
                    }
                }

            }
        }
        $data = $request->validate($rules);

        $this->save($request, $doctor, $type);

        return redirect()->back()
                        ->with('success', 'Successfully updated doctor!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     */
    public function destroy(Doctor $doctor)
    {
    }

    private function save($request, $doctor, $from = null)
    {
        $doctor->fill($request->all());
        if($from == 'settings'){
            $user = $doctor->user;
            $user->email = $request->email;
            $user->password = $request->filled('password') ? Hash::make($request->password) : $user->password;
            $user->save();
        }
        if($from == 'edit'){
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

        }
        $doctor->save();
    }
}
