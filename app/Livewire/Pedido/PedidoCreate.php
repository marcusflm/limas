<?php

namespace App\Livewire\Pedido;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\StatusPedido;
use Livewire\Component;

class PedidoCreate extends Component
{
    public $cliente_id;

    public function save()
    {
        $cliente = Cliente::with('bairro')->where('id', $this->cliente_id)->first();
        $valor_frete = $cliente->bairro->frete;

        $pedido = Pedido::create([
            'cliente_id' => $this->cliente_id,
            'data_pedido' => now(),
            'valor_frete' => $valor_frete,
            'valor_total' => $valor_frete
        ]);

        return redirect()->to("/pedidos/{$pedido->id}");
    }

    public function render()
    {
        return view(
            'livewire.pedido.create',
            [
                'clientes' => Cliente::all()
            ]
        );
    }
}
