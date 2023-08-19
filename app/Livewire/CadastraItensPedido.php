<?php

namespace App\Livewire;

use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Models\Produto;
use Livewire\Component;

class CadastraItensPedido extends Component
{
    public $pedido_id;
    public $produto_id;
    public $valor_unitario;
    public $quantidade;
    public $valor_total;
    public Pedido $pedido;

    public function mount(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    public function save()
    {
        // dd($this->quantidade);
        $produto = Produto::where('id', $this->produto_id)->get();
        $valor_unitario = $produto[0]->valor;
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

        return redirect()->to("itens-pedido/{$this->pedido->id}");
    }

    public function render()
    {
        return view('livewire.cadastra-itens-pedido', ['produtos' => Produto::all()]);
    }
}
