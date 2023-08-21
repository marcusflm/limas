<?php

namespace App\Livewire;

use App\Models\Pedido;
use App\Traits\Navegavel;
use Livewire\Component;

class Pedidos extends Component
{
    use Navegavel;

    public function cadastrar()
    {
        return redirect()->to('pedidos/cadastrar');
    }

    public function render()
    {
        $pedidos = Pedido::with('cliente')->with('status_pagamento')->with('status_pedido')->get();

        // dd($clientes);
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'cliente.nome', 'label' => 'Cliente'],
            ['key' => 'data_pedido', 'label' => 'Data pedido'],
            ['key' => 'status_pagamento.nome', 'label' => 'Status pagamento'],
            ['key' => 'status_pedido.nome', 'label' => 'Status pedido'],
            ['key' => 'valor_itens', 'label' => 'Subtotal'],
            ['key' => 'valor_frete', 'label' => 'Frete'],
            ['key' => 'valor_desconto', 'label' => 'Desconto'],
            ['key' => 'valor_total', 'label' => 'Total']
        ];

        return view('livewire.pedidos', ['pedidos' =>  $pedidos, 'headers' => $headers]);
    }
}
