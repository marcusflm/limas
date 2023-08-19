<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use Livewire\Component;

class CadastraPedido extends Component
{
    public $cliente_id;
    public $valor_itens;
    public $valor_frete;
    public $valor_desconto;
    public $valor_total;
    public $data_pedido;

    public function save()
    {
        $cliente = Cliente::with('bairro')->where('id', $this->cliente_id)->get();
        $valor_frete = $cliente[0]->bairro->frete;

        Pedido::create([
            'cliente_id' => $this->cliente_id,
            'data_pedido' => date("Y-m-d"),
            'valor_itens' => 0,
            'valor_frete' => $valor_frete,
            'valor_desconto' => 0,
            'valor_total' => $valor_frete,
            'status_pedido_id' => 1,
            'status_pagamento_id' => 1
        ]);
        return redirect()->to('/pedidos');
    }

    public function render()
    {
        return view(
            'livewire.cadastra-pedido',
            [
                'clientes' => Cliente::all(),
                'produtos' => Produto::all()
            ]
        );
    }
}
