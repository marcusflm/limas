<?php

namespace App\Livewire\Usuario;

use App\Models\User;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class UsuarioCreate extends Component
{
    use LivewireAlert;
    use Navegavel;

    #[Rule('required')]
    public $nome;

    #[Rule('required|email|unique:users')]
    public $email;

    #[Rule('required')]
    public $password;

    public function save()
    {
        User::create($this->validate());
        $this->alert('success', 'Usuario criado com sucesso!');
        $this->dispatch('usuario-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.usuario.create');
    }
}
