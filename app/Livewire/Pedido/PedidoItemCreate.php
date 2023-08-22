<?php

namespace App\Livewire\Pedido;

use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Models\Produto;
use App\Traits\Navegavel;
use Livewire\Component;

class PedidoItemCreate extends Component
{
    use Navegavel;

    public Pedido $pedido;

    public $produto_id;
    public $quantidade = 1;

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

    public function save()
    {
        $produto = Produto::where('id', $this->produto_id)->first();
        $valor_unitario = $produto->valor;
        $valor_total = $valor_unitario * $this->quantidade;

        ItensPedido::create([
            'pedido_id' => $this->pedido->id,
            'produto_id' => $this->produto_id,
            'valor_unitario' => $valor_unitario,
            'quantidade' => $this->quantidade,
            'valor_total' =>  $valor_total
        ]);

        $pedido = Pedido::find($this->pedido->id);
        $pedido->valor_itens = $pedido->valor_itens + $valor_total;
        $pedido->valor_total = $pedido->valor_total + $valor_total;
        $pedido->save();

        return redirect()->to("pedidos/{$this->pedido->id}/itens");
    }

    public function render()
    {
        return view(
            'livewire.pedido.itens.create',
            [
                'produtos' => Produto::all()
            ]
        );
    }
}
