<?php

namespace App\Livewire\Cliente;

use App\Models\Cliente;
use App\Traits\Navegavel;
use Livewire\Component;

class ClienteIndex extends Component
{
    use Navegavel;

    public $termo = '';

    public function render()
    {

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'telefone', 'label' => 'Telefone'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'bairro.nome', 'label' => 'Bairro'],
        ];

        $clientes = Cliente::with('bairro')->where('nome', 'like', "%{$this->termo}%")->get();

        return view('livewire.cliente.index', ['clientes' => $clientes, 'headers' => $headers]);
    }
}
