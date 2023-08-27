<?php

namespace App\Livewire\Cliente;

use App\Models\Bairro;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ClienteShow extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Cliente $cliente;

    #[Rule('required')]
    public $nome;

    #[Rule('required|min:10')]
    public $telefone;

    #[Rule('required|email')]
    public $email;

    #[Rule('required')]
    public $bairro_id;

    public bool $myModal = false;

    function mount()
    {
        $this->nome = $this->cliente->nome;
        $this->telefone = $this->cliente->telefone;
        $this->email = $this->cliente->email;
        $this->bairro_id = $this->cliente->bairro_id;
    }

    public function edit(Cliente $cliente)
    {

        dd($cliente);
    }

    public function save()
    {
        if ($this->cliente->update($this->validate())) {
            $this->flash('success', 'Cliente alterado com sucesso!', [], '/clientes');
        } else {
            $this->flash('error', 'Cliente não foi alterado!');
        }
    }

    public function render()
    {
        $pedidos = Pedido::where('cliente_id', $this->cliente->id)->get();

        $headers = [
            ['key' => 'data_pedido', 'label' => 'Data pedido'],
            ['key' => 'status_pagamento.nome', 'label' => 'Status pagamento'],
            ['key' => 'status_pedido.nome', 'label' => 'Status pedido'],
            ['key' => 'valor_total', 'label' => 'Total']
        ];

        return view(
            'livewire.cliente.show',
            [
                'pedidos' => $pedidos,
                'headers' => $headers
            ]
        );
    }
}
