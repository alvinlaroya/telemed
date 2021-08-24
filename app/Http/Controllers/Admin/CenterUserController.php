<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CenterUserController extends Controller
{
    /**
     * Display a listing of the user for specified center.
     * 
     * @param  \App\ServiceCategory  $serviceCategory
     */
    public function index(ServiceCategory $serviceCategory)
    {
        $users = $serviceCategory->users()->latest()->paginate(10);
        return view('admin.service-categories.users.index', compact('serviceCategory', 'users'));
    }

    /**
     * Show the form for creating a new user for specified center.
     * 
     * @param  \App\ServiceCategory  $serviceCategory
     */
    public function create(ServiceCategory $serviceCategory)
    {
        abort(404);
        return view('admin.service-categories.users.create', compact('serviceCategory'));
    }

    /**
     * Store a newly created user in storage for a specified center.
     *
     * @param  \App\ServiceCategory  $serviceCategory
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(ServiceCategory $serviceCategory, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);
        $request->merge(array('status' => $request->status == 1 ? true : false));

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = User::CENTERADMIN;
        $user->status = $request->status;
        $user->save();

        $serviceCategory->users()->attach($user->id);

        return redirect()->route('admin.service-categories.users.index', $serviceCategory)
                        ->with('success', 'Successfully added administrator!');
    }

    /**
     * Display the specified user for specified center.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified user for specified center.
     *
     * @param  \App\ServiceCategory  $serviceCategory
     * @param  \App\User  $user
     */
    public function edit(ServiceCategory $serviceCategory, User $user)
    {
        abort(404);
        return view('admin.service-categories.users.edit', compact('serviceCategory', 'user'));
    }

    /**
     * Update the specified user in storage for specified center.
     *
     * @param  \App\ServiceCategory  $serviceCategory
     * @param  \App\User  $user
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(ServiceCategory $serviceCategory, User $user, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);
        $request->merge(array('status' => $request->status == 1 ? true : false));

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->filled('password') ? Hash::make($request->password) : $user->password;
        $user->status = $request->status;
        $user->save();

        return redirect()->back()
                        ->with('success', 'Successfully updated administrator!');
    }

    /**
     * Remove the specified user from storage for specified center.
     *
     * @param  \App\ServiceCategory  $serviceCategory
     * @param  \App\User  $user
     */
    public function destroy(ServiceCategory $serviceCategory, User $user)
    {
        abort(404);
        $serviceCategory->users()->detach($user->id);
        $user->delete();

        return redirect()->back()
                        ->with('success', 'Successfully deleted!');
    }
}
