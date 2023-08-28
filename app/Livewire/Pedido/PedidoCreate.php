<?php

namespace App\Livewire\Pedido;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\StatusPedido;
use App\Traits\Navegavel;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PedidoCreate extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Pedido $pedido;

    #[Rule('required')]
    public $cliente_id = null;

    public Collection $clientes;

    public function mount()
    {
        $this->search();
    }

    public function search(string $value = '')
    {
        $this->clientes = Cliente::query()
            ->where('nome', 'like', "%{$value}%")
            ->take(5)
            ->get();
    }

    public function save()
    {
        $this->validate();

        $temPedidoAberto = Pedido::query()
            ->where('cliente_id', $this->cliente_id)
            ->where('status_pedido_id', StatusPedido::ABERTO)
            ->count() > 0;

        if ($temPedidoAberto) {
            $this->alert('error', 'Cliente com pedido aberto!');
            return;
        }

        $cliente = Cliente::with('bairro')->where('id', $this->cliente_id)->first();
        $valor_frete = $cliente->bairro->frete;

        $pedido = Pedido::create([
            'cliente_id' => $this->cliente_id,
            'data_pedido' => now(),
            'valor_frete' => $valor_frete,
            'valor_total' => $valor_frete
        ]);

        return redirect()->to("pedidos/{$pedido->id}");
    }

    public function render()
    {
        return view('livewire.pedido.create');
    }
}
