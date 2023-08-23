<?php

namespace App\Livewire\Cliente;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ClienteIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public $termo = '';

    public function delete(Cliente $cliente)
    {
        if ($cliente->pedidos()->count()) {
            $this->alert('error', 'Cliente possui pedidos!');
            return;
        }

        $cliente->delete();
        $this->alert('success', 'Cliente apagado!');
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
