<?php

namespace App\Livewire\Pedido;

use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\StatusPedido;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PedidoItemList extends Component
{
    use LivewireAlert;

    public Pedido $pedido;

    public ItensPedido $item;

    #[Rule('required')]
    public $produto_id;

    #[Rule('required')]
    public $quantidade = 1;

    public bool $myModal = false;

    #[On('pedido-edicao-concluida')]
    public function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function edit(ItensPedido $item)
    {
        if ($this->pedido->status_pedido_id == StatusPedido::ABERTO) {
            $this->item = $item;
            $this->myModal = true;
        }
    }

    public function delete(ItensPedido $item)
    {
        try {
            DB::beginTransaction();

            $valor_total_itens = $item->valor_total;
            $item->delete();

            $this->pedido->valor_itens = $this->pedido->valor_itens - $valor_total_itens;
            if ($this->pedido->itensPedido()->count() > 0) {
                $this->pedido->valor_total = $this->pedido->valor_total - $valor_total_itens;
            } else {
                $this->pedido->valor_total = 0;
            }
            $this->pedido->save();

            DB::commit();

            return redirect()->to("/pedidos/{$this->pedido->id}");
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->alert('error', 'Erro ao deletar item!');
        }
    }

    public function render()
    {
        $itensPedido = ItensPedido::with('produto')->where('pedido_id', $this->pedido->id)->get();

        $headers = [
            ['key' => 'produto.id', 'label' => 'Código'],
            ['key' => 'produto.nome', 'label' => 'Produto'],
            ['key' => 'quantidade', 'label' => 'Quantidade'],
            ['key' => 'valor_unitario', 'label' => 'Valor unitário'],
            ['key' => 'valor_total', 'label' => 'Valor total'],
        ];

        return view('livewire.pedido.pedido-item-list', [
            'headers' => $headers,
            'itensPedido' => $itensPedido,
            'produtos' => Produto::all(),
        ]);
    }
}
