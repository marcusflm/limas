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

    public $termo = '';

    public bool $myModal = false;

    public function create()
    {
        $this->myModal = true;
    }

    public function delete(Pedido $pedido)
    {
        if ($pedido->status_pedido_id != 1) {
            $this->alert('error', 'Pedido está fechado!');
            return;
        }

        $pedido->delete();
        $this->alert('success', 'Pedido apagado!');
    }

    public function altera_status_pagamento(Pedido $pedido)
    {
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
            ['key' => 'valor_total', 'label' => 'Total']
        ];

        $pedidos = Pedido::with('cliente')->with('status_pagamento')->with('status_pedido')->get();
        // dd($this);
        // $pedidos = $pedidos->where("{$pedidos->cliente->nome}", 'like', "%{$this->termo}%");

        return view('livewire.pedido.index', ['pedidos' =>  $pedidos, 'headers' => $headers]);
    }
}
