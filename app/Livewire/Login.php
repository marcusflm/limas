<?php

namespace App\Livewire;

use Illuminate\Http\Client\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';

    public string $senha = '';

    public function autenticar(Request $request)
    {
    }

    public function render()
    {
        return view('livewire.login');
    }
}
