<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {
        $search = $request->filled('search') ? $request->search : null;
        $status = $request->filled('status') ? $request->status : null;
        $users = User::where('id', '!=', auth()->user()->id)
            ->whereIn('role', [User::SUPERADMIN, User::ADMIN, User::CENTERADMIN, User::MEDICAL_SERVICES, User::SUPPORT])
            ->where(function($query) use ($search, $status){
                $query->when($search, function($query) use($search) {
                    $query->where('name', 'LIKE', "%$search%");
                })
                ->when($status === "1" || $status === "0", function($query) use($status) {
                    $query->where('status', $status);
                });
            })
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:5|confirmed',
        );
        if($request->role == User::CENTERADMIN){
            $rules['centers'] = 'required';
        }
        $data = $request->validate($rules);
        $request->merge(array('status' => $request->status == 1 ? true : false));

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->input('role', User::ADMIN);
        $user->status = $request->status;
        $user->save();

        if($user->role == User::CENTERADMIN){
            $user->centers()->sync($request->centers);
        }

        return redirect()->route('admin.users.index')
                        ->with('success', 'Successfully added user!');
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\User  $user
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     */
    public function update(Request $request, User $user)
    {
        $rules = array(
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
        );
        if($request->role == User::CENTERADMIN){
            $rules['centers'] = 'required';
        }
        $data = $request->validate($rules);
        $request->merge(array('status' => $request->status == 1 ? true : false));

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->filled('password') ? Hash::make($request->password) : $user->password;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();

        if($user->role == User::CENTERADMIN){
            $user->centers()->sync($request->centers);
        }else{
            $user->centers()->detach();
        }

        return redirect()->back()
                        ->with('success', 'Successfully updated user!');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\User  $user
     */
    public function destroy(User $user)
    {
        if($user->role == User::CENTERADMIN){
            $user->centers()->detach();
        }

        $user->delete();

        return redirect()->back()
                        ->with('success', 'Successfully deleted!');
    }
}
