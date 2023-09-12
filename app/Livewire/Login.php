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
            return $this->redirect('/', navigate: true);
        }

        $this->addError('password', 'Credenciais inválidas.');
    }

    public function render()
    {
        return Auth::user() ? view('livewire.index') : view('livewire.login');
    }
}
