<?php

namespace App\Livewire\Cliente;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Traits\Navegavel;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ClienteShow extends Component
{
    use Navegavel;
    public Cliente $cliente;

    public $pedidos;

    #[Rule('required')]
    public $nome;

    #[Rule('required|min:10')]
    public $telefone;

    #[Rule('required|email')]
    public $email;

    #[Rule('required')]
    public $bairro_id;

    public bool $myModal = false;

    #[On('cliente-edicao-concluida')]
    function fechaModal(): void
    {
        $this->myModal = false;
    }

    function mount()
    {
        $this->nome = $this->cliente->nome;
        $this->telefone = $this->cliente->telefone;
        $this->email = $this->cliente->email;
        $this->bairro_id = $this->cliente->bairro_id;
        $this->pedidos = Pedido::where('cliente_id', $this->cliente->id)->get();
    }

    public function render()
    {
        $headers = [
            ['key' => 'data_pedido', 'label' => 'Data pedido'],
            ['key' => 'status_pagamento.nome', 'label' => 'Status pagamento'],
            ['key' => 'status_pedido.nome', 'label' => 'Status pedido'],
            ['key' => 'valor_total', 'label' => 'Total']
        ];

        return view(
            'livewire.cliente.show',
            [
                'headers' => $headers
            ]
        );
    }
}
