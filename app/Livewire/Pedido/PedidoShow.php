<?php

namespace App\Livewire\Pedido;

use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Traits\Navegavel;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PedidoShow extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Pedido $pedido;

    public $itensPedido;

    #[Rule('decimal:0,2')]
    public $valor_desconto;

    #[Rule('decimal:0,2')]
    public $valor_itens;

    #[Rule('decimal:0,2')]
    public $valor_total;

    #[Rule('decimal:0,2')]
    public $valor_frete;

    public $observacao;

    public bool $myModal = false;

    public function mount()
    {
        $this->valor_desconto = $this->pedido->valor_desconto;
        $this->valor_frete = $this->pedido->valor_frete;
        $this->valor_total = $this->pedido->valor_total;
        $this->valor_itens = $this->pedido->valor_itens;
        $this->observacao = $this->pedido->observacao;

        $this->itensPedido = ItensPedido::where('pedido_id', $this->pedido->id)->get();
    }

    public function alterar_status_pedido()
    {
        if ($this->pedido->status_pedido_id == 1) {
            $this->pedido->status_pedido_id = 2;
            $this->pedido->valor_desconto = $this->valor_desconto;
            $this->pedido->valor_total = $this->valor_total - $this->valor_desconto;
            $this->pedido->observacao = $this->observacao;
            $this->pedido->save();
            $this->flash('success', 'Pedido fechado com sucesso!', [], '/pedidos');
        }
    }

    public function render()
    {
        return view('livewire.pedido.show');
    }
}
