<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SecretaryController extends Controller
{
    /**
     * Display a listing of doctor secretaries.
     * 
     * @param  \App\Doctor  $doctor
     */
    public function index(Doctor $doctor)
    {
        $secretaries = $doctor->secretaries()->latest()->paginate(10);
        return view('admin.doctors.secretaries.index', compact('doctor', 'secretaries'));
    }

    /**
     * Show the form for creating a new secretary.
     * 
     * @param  \App\Doctor  $doctor
     */
    public function create(Doctor $doctor)
    {
        return view('admin.doctors.secretaries.create', compact('doctor'));
    }

    /**
     * Store a newly created secretary in storage.
     *
     * @param  \App\Doctor  $doctor
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Doctor $doctor, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);

        $secretary = new User;
        $secretary->name = $request->name;
        $secretary->email = $request->email;
        $secretary->password = Hash::make($request->password);
        $secretary->role = User::SECRETARY;
        $secretary->save();

        $doctor->secretaries()->attach($secretary->id);

        return redirect()->route('admin.doctors.secretaries.index', $doctor)
                        ->with('success', 'Successfully added secretary!');
    }

    /**
     * Display the specified secretary.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified secretary.
     *
     * @param  \App\Doctor  $doctor
     * @param  \App\User  $secretary
     */
    public function edit(Doctor $doctor, User $secretary)
    {
        return view('admin.doctors.secretaries.edit', compact('doctor', 'secretary'));
    }

    /**
     * Update the specified secretary in storage.
     *
     * @param  \App\Doctor  $doctor
     * @param  \App\User  $secretary
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Doctor $doctor, User $secretary, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($secretary->id),
            ],
        ]);

        $secretary->name = $request->name;
        $secretary->email = $request->email;
        $secretary->password = $request->filled('password') ? Hash::make($request->password) : $secretary->password;
        $secretary->save();

        return redirect()->back()
                        ->with('success', 'Successfully updated secretary!');
    }

    /**
     * Remove the specified secretary from storage.
     *
     * @param  \App\Doctor  $doctor
     * @param  \App\User  $secretary
     */
    public function destroy(Doctor $doctor, User $secretary)
    {
        $doctor->secretaries()->detach($secretary->id);
        $secretary->delete();

        return redirect()->back()
                        ->with('success', 'Successfully deleted!');
    }
}
