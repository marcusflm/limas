<?php

namespace App\Livewire\Usuario;

use App\Models\User;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Rule;
use Livewire\Component;

class UsuarioEdit extends Component
{
    use LivewireAlert;
    use Navegavel;

    #[Reactive]
    public User $usuario;

    #[Rule('required')]
    public $nome;

    #[Rule('required|email')]
    public $email;

    #[Rule('required')]
    public $password;

    public function boot()
    {
        $this->nome = $this->usuario->nome;
        $this->email = $this->usuario->email;
    }

    public function save()
    {
        $this->usuario->fresh()->update($this->validate());
        $this->alert('success', 'Senha alterada com sucesso!');
        $this->dispatch('usuario-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.usuario.edit');
    }
}
