<?php

namespace App\Livewire\Pedido;

use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Models\Produto;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PedidoItemCreate extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Pedido $pedido;

    #[Rule('required')]
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

        if (ItensPedido::create([
            'pedido_id' => $this->pedido->id,
            'produto_id' => $this->produto_id,
            'valor_unitario' => $valor_unitario,
            'quantidade' => $this->quantidade,
            'valor_total' =>  $valor_total
        ])) {
            $this->pedido->valor_itens = $this->pedido->valor_itens + $valor_total;
            $this->pedido->valor_total = $this->pedido->valor_total + $valor_total;
            $this->pedido->save();
            return redirect()->to("pedidos/{$this->pedido->id}");
        } else {
            $this->flash('error', 'Item não foi adicionado!');
        }
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
