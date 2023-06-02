<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember;

    public function render()
    {
        return view('livewire.login');
    }

    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
            'remember_token' => $this->remember,
        ];

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            // Authentication successful
            return redirect()->intended(route('blogs.index'));
        } else {
            // Reset the form fields
            $this->reset();
            // Authentication failed
            $this->addError('email', trans('auth.failed'));
        }
    }
}
