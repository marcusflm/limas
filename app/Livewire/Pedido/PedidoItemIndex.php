<?php

namespace App\Livewire\Pedido;

use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Traits\Navegavel;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PedidoItemIndex extends Component
{
    use Navegavel;

    public Pedido $pedido;

    #[Rule('decimal:0,2')]
    public float $valor_desconto;

    #[Rule('decimal:0,2')]
    public float $valor_total;

    public function mount()
    {
        $this->valor_desconto = $this->pedido->valor_desconto;
        $this->valor_total = $this->pedido->valor_total;
    }

    public function alterar_status_pedido(int $pedido_id)
    {
        $pedido = Pedido::findOrFail($pedido_id);
        if ($pedido->status_pedido_id == 1) {
            $pedido->status_pedido_id = 2;
            $pedido->valor_desconto = $this->pedido->valor_desconto;
            $pedido->valor_total = $this->pedido->valor_total - $this->pedido->valor_desconto;
            $pedido->save();
        }
        // else {
        //     $pedido->status_pedido_id = 1;
        // }
    }

    public function delete(int $id)
    {
        $item = ItensPedido::findOrFail($id);
        $pedido_id = $item->pedido_id;
        $valor_total_itens = $item->valor_total;
        $item->delete();

        $pedido = Pedido::findOrFail($pedido_id);
        $pedido->valor_itens = $pedido->valor_itens - $valor_total_itens;
        $pedido->valor_total = $pedido->valor_total - $valor_total_itens;
        $pedido->save();
        // $this->authorize('delete', $post);

    }

    public function render()
    {
        $itensPedido = ItensPedido::with('produto')->where('pedido_id', $this->pedido->id)->get();
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'produto.nome', 'label' => 'Produto'],
            ['key' => 'quantidade', 'label' => 'Quantidade'],
            ['key' => 'valor_unitario', 'label' => 'Valor unitário'],
            ['key' => 'valor_total', 'label' => 'Valor total']
        ];

        // $pedido = Pedido::findOrFail($this->pedido->id);
        // $valor_desconto = $pedido->valor_desconto;
        // $pedido->valor_total = $pedido->valor_total - $valor_desconto;

        return view('livewire.pedido.itens.index', ['headers' => $headers, 'itensPedido' => $itensPedido]);
    }
}
