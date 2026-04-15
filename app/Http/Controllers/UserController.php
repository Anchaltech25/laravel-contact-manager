<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class UserController extends Controller
{
     public function index()
        {
            $users = User::with('role')->latest()->paginate(10);
            return view('users.index', compact('users'));
        }

       public function create(Request $request)
{
     $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role_id' => 'required|exists:roles,id',
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // handle image
    if ($request->hasFile('profile_image')) {
        $data['profile_image'] = $request->file('profile_image')
                                        ->store('profile_images', 'public');
    }

    // hash password
    $data['password'] = Hash::make($data['password']);

    // create user
    $user = User::create($data);

    Auth::login($user);

    return redirect()->route('contacts.index');
}

       public function show($id)
{
    $user = User::with('role')->findOrFail($id); // ✅ eager load role


    $roles = \App\Models\Role::all();

    return view('users.show', compact('user', 'roles'));
}

public function edit($id)
{
    $user = User::with('role')->findOrFail($id); // ✅ eager load role
    $roles = \App\Models\Role::all();
    // dd($user);
    return view('users.edit', compact('user', 'roles'));
}


  public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role_id' => 'required|exists:roles,id',
        'password' => 'nullable|min:6|confirmed',
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // password
    if (!empty($data['password'])) {
        $data['password'] = Hash::make($data['password']);
    } else {
        unset($data['password']);
    }

    // image
    if ($request->hasFile('profile_image')) {

        if ($user->profile_image) {
            \Storage::disk('public')->delete($user->profile_image);
        }

        $data['profile_image'] = $request->file('profile_image')
                                        ->store('profile_images', 'public');
    }

    $user->update($data);

    return redirect()->route('users.index')->with('success', 'User updated');
}


    
        public function destroy($id)
    {
       $user = User::with('role')->findOrFail($id); 
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted');
    }
}
