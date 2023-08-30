<?php

namespace App\Livewire\Cliente;

use App\Models\Cliente;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ClienteIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public string $termo = '';

    public bool $myModal = false;

    #[On('cliente-edicao-concluida')]
    function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function create()
    {
        unset($this->cliente);
        $this->myModal = true;
    }

    public function delete(Cliente $cliente)
    {
        if ($cliente->pedidos()->count()) {
            $this->alert('error', 'Cliente possui pedidos!');
            return;
        }

        $cliente->delete();
        $this->alert('success', 'Cliente apagado!');
    }

    public function formataTelefone($fone)
    {
        if (!$fone) {
            return '';
        }

        if (strlen($fone) == 10) {
            return '(' . substr($fone, 0, 2) . ') ' . substr($fone, 2, 4) . '-' . substr($fone, 6);
        }

        if (strlen($fone) == 11) {
            return '(' . substr($fone, 0, 2) . ') ' . substr($fone, 2, 1) . ' ' . substr($fone, 3, 4) . '-' . substr($fone, 7);
        }

        return $fone;
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'telefone', 'label' => 'Telefone'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'bairro.nome', 'label' => 'Bairro'],
        ];

        $clientes = Cliente::query()
            ->with('bairro')
            ->where('nome', 'like', "%{$this->termo}%")
            ->get();

        return view('livewire.cliente.index', [
            'clientes' => $clientes,
            'headers' => $headers
        ]);
    }
}
