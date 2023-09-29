<?php

namespace App\Livewire\Pedido;

use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Models\StatusPedido;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PedidoShow extends Component
{
    use LivewireAlert;
    use Navegavel;

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

    #[On('pedido-edicao-concluida')]
    public function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function mount()
    {
        $this->valor_desconto = $this->pedido->valor_desconto;
        $this->valor_frete = $this->pedido->valor_frete;
        $this->valor_total = $this->pedido->valor_total;
        $this->valor_itens = $this->pedido->valor_itens;
        $this->observacao = $this->pedido->observacao;

        $this->itensPedido = ItensPedido::with('pedido')->get();
    }

    public function alterar_status_pedido()
    {
        if ($this->pedido->isAberto()) {
            $this->pedido->status_pedido_id = StatusPedido::FECHADO;
            $this->pedido->valor_desconto = $this->valor_desconto;
            $this->pedido->valor_total = $this->valor_itens + $this->valor_frete - $this->valor_desconto;
            $this->pedido->observacao = $this->observacao;
            $this->pedido->save();
            $this->alert('success', 'Pedido fechado com sucesso!');
            $this->navegar('/pedidos');
        }
    }

    public function grava_observacao()
    {
        $this->pedido->observacao = $this->observacao;
        $this->pedido->save();
        $this->alert('success', 'Observação salva!');
    }

    public function render()
    {
        return view('livewire.pedido.show');
    }
}
