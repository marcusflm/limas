<?php

namespace App\Livewire;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public function autenticar()
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            session_start();
            // $request()->session()->regenerate();
            $_SESSION['email'] = $this->email;

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function sair()
    {
        session_destroy();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
