<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{
    #[Rule('required|email')]
    public string $email;

    #[Rule('required')]
    public string $password;

    public function autenticar()
    {
        if (Auth::attempt($this->validate())) {

            // session_start();
            // $request()->session()->regenerate();
            // $_SESSION['email'] = $this->email;

            return redirect()->to('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function render()
    {
        if (Auth::check()) {
            return view('livewire.index');
        }

        return view('livewire.login');
    }
}
