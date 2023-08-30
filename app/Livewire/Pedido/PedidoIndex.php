<?php

namespace App\Livewire\Pedido;

use App\Models\Pedido;
use App\Models\StatusPagamento;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class PedidoIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public $termo = '';

    public bool $myModal = false;

    #[On('pedido-edicao-concluida')]
    function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function delete(Pedido $pedido)
    {
        if ($pedido->isFechado()) {
            $this->alert('error', 'Pedido está fechado!');
            return;
        }

        $pedido->delete();
        $this->alert('success', 'Pedido apagado!');
    }

    public function altera_status_pagamento(Pedido $pedido)
    {
        if ($pedido->isPendente()) {
            $pedido->status_pagamento_id = StatusPagamento::PAGO;
            $pedido->save();
            $this->navegar('/pedidos');
        }
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
