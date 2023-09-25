<?php

namespace App\Livewire\Usuario;

use App\Models\User;
use App\Traits\Navegavel;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class UsuarioShow extends Component
{
    use Navegavel;

    public User $usuario;

    public $nome;

    #[Rule('required|email')]
    public $email;

    #[Rule('required')]
    public $password;

    public bool $myModal = false;

    #[On('usuario-edicao-concluida')]
    public function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function mount()
    {
        $this->nome = $this->usuario->nome;
        $this->email = $this->usuario->email;
    }

    public function render()
    {
        $headers = [
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'email', 'label' => 'E-mail'],
        ];

        return view('livewire.usuario.show',
            [
                'headers' => $headers,
            ]
        );
    }
}
