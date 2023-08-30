<?php

namespace App\Livewire\Pedido;

use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Models\Produto;
use App\Traits\Navegavel;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PedidoItemEdit extends Component
{
    use Navegavel;
    use LivewireAlert;

    public $item;

    #[Rule('required')]
    public $produto_id = null;

    #[Rule('required')]
    public $quantidade = null;

    public function aumentar()
    {
        $this->quantidade++;
    }

    public function diminuir()
    {
        if ($this->quantidade > 1) {
            $this->quantidade--;
        }
    }

    function mount()
    {
        $this->produto_id = $this->item->produto_id;
        $this->quantidade = $this->item->quantidade;
    }

    public function save()
    {
        $this->validate();

        $itensPedido = ItensPedido::query()
            ->where('pedido_id', $this->item->pedido_id)
            ->where('produto_id', $this->produto_id)
            ->whereNot(function (Builder $query) {
                $query->where('id', $this->item->id);
            })->get();

        if ($itensPedido->count() > 0) {
            $this->alert('error', 'Item já existe no pedido!');
            return;
        }

        $pedido = Pedido::where('id', $this->item->pedido_id)->first();

        try {
            DB::beginTransaction();

            $this->item->produto_id = $this->produto_id;
            $this->item->quantidade = $this->quantidade;
            $this->item->valor_total = ($this->item->valor_unitario * $this->quantidade);
            $this->item->update();

            $itensPedido = $pedido->itensPedido()->get();
            $valor_total = 0;
            foreach ($itensPedido as $itemPedido) {
                $valor_total = $valor_total + $itemPedido->valor_total;
            }

            $pedido->valor_itens = $valor_total;
            $pedido->valor_total = $pedido->valor_itens + $pedido->valor_frete;
            $pedido->save();

            DB::commit();

            $this->navegar("/pedidos/{$this->item->pedido_id}");
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->flash('error', 'Item não foi alterado!', [], "/pedidos/{$this->item->pedido_id}");
        }
    }

    public function render()
    {
        return view('livewire.pedido.pedido-item-edit', ['produtos' => Produto::all()]);
    }
}
