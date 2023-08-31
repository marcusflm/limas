<?php

namespace App\Livewire\Compra;

use App\Models\Compra;
use App\Models\Mercado;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CompraCreate extends Component
{
    public Compra $compra;

    #[Rule('required|date')]
    public $data_compra;

    #[Rule('required')]
    public $mercado_id = null;

    public $mercados;

    public function mount()
    {
        $this->search();
    }

    public function search(string $value = '')
    {
        $this->mercados = Mercado::query()
            ->where('nome', 'like', "%{$value}%")
            ->take(5)
            ->get();
    }

    public function save()
    {
        $compra = Compra::create($this->validate());

        // $temPedidoAberto = Pedido::query()
        //     ->where('cliente_id', $this->cliente_id)
        //     ->where('status_pedido_id', StatusPedido::ABERTO)
        //     ->count() > 0;

        // if ($temPedidoAberto) {
        //     $this->alert('error', 'Cliente com pedido aberto!');
        //     return;
        // }

        // $cliente = Cliente::with('bairro')->where('id', $this->cliente_id)->first();
        // $valor_frete = $cliente->bairro->frete;

        // $pedido = Compra::create([
        //     'mercado_id' => $this->cliente_id,
        //     'data_pedido' => now(),
        //     'valor_frete' => $valor_frete,
        //     'valor_total' => 0
        // ]);

        return redirect()->to("compras/{$compra->id}");
    }

    public function render()
    {
        return view('livewire.compra.create');
    }
}
