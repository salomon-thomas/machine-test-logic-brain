<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use App\Rules\ValidRole;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;
    public $successMessage;

    public function dismissSuccessMessage()
    {
        $this->successMessage = null;
    }
    public function render()
    {
        $roles = Role::where('name', '!=', 'admin')->get();
        return view('livewire.create-user', compact('roles'));
    }

    public function mount()
    {
        $this->listeners = ['dismissSuccessMessage'];
    }

    public function store()
    {
        // Validate the form data
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => ['required', new ValidRole],
        ]);

        // Create the user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'roles_id' => Role::where('name', $validatedData['role'])->pluck('id')->first()
        ]);

        // Reset the form fields
        $this->reset();

        // Redirect or show success message
        $this->successMessage = 'User created successfully.';
    }
}
