<?php

namespace App\Livewire\Pedido;

use App\Models\Pedido;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PedidoIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Pedido $pedido;

    public $termo = '';

    public function delete(int $id)
    {
        $pedido = Pedido::findOrFail($id);
        if ($pedido->status_pedido_id == 1) {
            $pedido->delete();
            $this->alert('success', 'Pedido apagado!');
        } else {
            $this->alert('error', 'Pedido está fechado!');
        }
    }

    public function altera_status_pagamento(int $pedido_id)
    {
        $pedido = Pedido::findOrFail($pedido_id);
        if ($pedido->status_pagamento_id == 1) {
            $pedido->status_pagamento_id = 2;
        } else {
            $pedido->status_pagamento_id = 1;
        }
        $pedido->save();
    }


    public function render()
    {
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

        $pedidos = Pedido::with('cliente')->with('status_pagamento')->with('status_pedido')->get();
        // dd($this);
        // $pedidos = $pedidos->where("{$pedidos->cliente->nome}", 'like', "%{$this->termo}%");

        return view('livewire.pedido.index', ['pedidos' =>  $pedidos, 'headers' => $headers]);
    }
}
