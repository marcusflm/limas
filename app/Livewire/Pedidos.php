<?php

namespace App\Livewire;

use App\Models\Pedido;
use Livewire\Component;

class Pedidos extends Component
{
    public function cadastrar()
    {
        return redirect()->to('pedidos/cadastrar');
    }

    public function navegar(int $pedido_id)
    {
        // $pedido = Pedido::where('id', $pedido_id)->get();
        // dd($pedido[0]->toArray());
        return redirect()->to("/itens-pedido/{$pedido_id}");
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
