<?php

namespace App\Livewire;

use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Models\Produto;
use Livewire\Component;

class ItensPedidos extends Component
{
    public Pedido $pedido;

    public function mount(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    public function cadastrar(int $pedido_id)
    {
        return redirect()->to("itens-pedido/{$pedido_id}/cadastrar");
    }

    public function render()
    {
        $itensPedido = ItensPedido::with('produto')->where('pedido_id', $this->pedido->id)->get();
        // dd($itensPedido);
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'produto.nome', 'label' => 'Produto'],
            ['key' => 'quantidade', 'label' => 'Quantidade'],
            ['key' => 'valor_unitario', 'label' => 'Valor unitário'],
            ['key' => 'valor_total', 'label' => 'Valor total']
        ];

        return view('livewire.itens-pedidos', ['headers' => $headers, 'itensPedido' => $itensPedido]);
    }
}
