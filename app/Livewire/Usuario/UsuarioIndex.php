<?php

namespace App\Livewire\Usuario;

use App\Models\User;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class UsuarioIndex extends Component
{
    use LivewireAlert;
    use Navegavel;

    public string $termo = '';

    public bool $myModal = false;

    public User $usuario;

    #[On('usuario-edicao-concluida')]
    public function fechaModal(): void
    {
        $this->myModal = false;
        $this->reset('usuario');
    }

    public function create()
    {
        $this->reset('usuario');
        $this->myModal = true;
    }

    public function delete(User $usuario)
    {
        if ($usuario->count() == 1) {
            $this->alert('error', 'Ao menos 1 usuário é necessário!');

            return;
        }

        $usuario->delete();
        $this->alert('success', 'Usuário apagado!');
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'email', 'label' => 'Email'],
        ];

        $usuarios = User::query()
            ->where('nome', 'like', "%{$this->termo}%")
            ->orWhere('email', 'like', "%{$this->termo}%")
            ->get();

        return view('livewire.usuario.index', [
            'headers' => $headers,
            'usuarios' => $usuarios,
        ]);
    }
}
