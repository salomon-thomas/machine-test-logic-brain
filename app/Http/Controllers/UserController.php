<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Rules\ValidRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create()
    {
        $roles=Role::where('name','!=','admin')->get();
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => ['required',new ValidRole],
        ]);

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'roles_id'=>Role::where('name', $validatedData['role'])->pluck('id')->first()
        ]);

        // Redirect to a success page or perform additional actions as needed
        return redirect()->route('create-user')->with('success', 'User created successfully.');
    }
}
