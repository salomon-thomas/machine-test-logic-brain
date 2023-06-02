<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function register()
    {
        $validatedData = $this->validate();

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'roles_id' => Role::where('name', 'user')->pluck('id')->first(),
        ]);
        //redirect to home after registration
        Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']]);
        return redirect()->intended(route('blogs.index'));

        $this->reset();
    }

    public function render()
    {
        return view('livewire.register');
    }
}
