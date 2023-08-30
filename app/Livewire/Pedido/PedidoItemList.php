<?php

namespace App\Livewire\Pedido;

use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Models\Produto;
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
    function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function edit(ItensPedido $item)
    {
        $this->item = $item;
        $this->myModal = true;
    }

    public function delete(ItensPedido $item)
    {
        try {
            DB::beginTransaction();

            $valor_total_itens = $item->valor_total;
            $item->delete();

            $this->pedido->valor_itens = $this->pedido->valor_itens - $valor_total_itens;
            $this->pedido->valor_total = $this->pedido->valor_total - $valor_total_itens;
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
            ['key' => 'id', 'label' => '#'],
            ['key' => 'produto.nome', 'label' => 'Produto'],
            ['key' => 'quantidade', 'label' => 'Quantidade'],
            ['key' => 'valor_unitario', 'label' => 'Valor unitário'],
            ['key' => 'valor_total', 'label' => 'Valor total']
        ];

        return view('livewire.pedido.pedido-item-list', [
            'headers' => $headers,
            'itensPedido' => $itensPedido,
            'produtos' => Produto::all()
        ]);
    }
}
