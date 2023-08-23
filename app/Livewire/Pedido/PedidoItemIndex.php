<?php

namespace App\Livewire\Pedido;

use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PedidoItemIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Pedido $pedido;

    #[Rule('decimal:0,2')]
    public float $valor_desconto;

    #[Rule('decimal:0,2')]
    public float $valor_total;

    #[Rule('decimal:0,2')]
    public float $valor_frete;

    public function mount()
    {
        $this->valor_desconto = $this->pedido->valor_desconto;
        $this->valor_frete = $this->pedido->valor_frete;
        $this->valor_total = $this->pedido->valor_total;
    }

    public function alterar_status_pedido()
    {
        if ($this->pedido->status_pedido_id == 1) {
            $this->pedido->status_pedido_id = 2;
            $this->pedido->valor_desconto = $this->valor_desconto;
            $this->pedido->valor_total = $this->valor_total - $this->valor_desconto;
            $this->pedido->save();
            $this->alert('success', 'Pedido foi fechado com sucesso!');
        }
    }

    public function delete(int $id)
    {
        if ($this->pedido->status_pedido_id == 1) {
            $item = ItensPedido::findOrFail($id);
            $valor_total_itens = $item->valor_total;
            $item->delete();

            $this->pedido->valor_itens = $this->pedido->valor_itens - $valor_total_itens;
            $this->pedido->valor_total = $this->pedido->valor_total - $valor_total_itens;
            $this->pedido->save();
        } else {
            $this->alert('error', 'Pedido está fechado!');
        }
        // $this->authorize('delete', $item);
    }

    public function cadastrar()
    {
        if ($this->pedido->status_pedido_id == 1) {
            return redirect()->to("/pedidos/{$this->pedido->id}/itens/create");
        } else {
            $this->alert('error', 'Pedido está fechado!');
        }
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

        return view('livewire.pedido.itens.index', [
            'headers' => $headers,
            'itensPedido' => $itensPedido,
        ]);
    }
}
