<?php

namespace App\Livewire\Pedido;

use App\Models\ItensPedido;
use App\Models\Lote;
use App\Models\Pedido;
use App\Models\Produto;
use App\Traits\Navegavel;
use Illuminate\Support\Facades\DB;
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

    #[Rule('required')]
    public $lote_id;

    public $quantidade = 1;

    public $produtos;
    public $lotes;

    public function mount()
    {
        $this->search();
        $this->search2();
    }

    public function search(string $value = '')
    {
        $this->produtos = Produto::query()
            ->where('nome', 'like', "%{$value}%")
            ->take(5)
            ->get();
    }

    public function search2(string $value = '')
    {
        $this->lotes = Lote::query()
            ->where('id', 'like', "%{$value}%")
            ->take(5)
            ->get();
    }

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
        $this->validate();

        $produtoJaAdicionado = $this->pedido
            ->itensPedido()
            ->where('produto_id', $this->produto_id)
            ->count();

        if ($produtoJaAdicionado) {
            $this->alert('error', 'Item já existe no pedido!');
            return;
        }

        $produto = Produto::where('id', $this->produto_id)->first();
        $valor_unitario = $produto->valor;
        $valor_total = $valor_unitario * $this->quantidade;
        // dd($valor_unitario);

        try {
            DB::beginTransaction();

            ItensPedido::create([
                'pedido_id' => $this->pedido->id,
                'produto_id' => $this->produto_id,
                'lote_id' => $this->lote_id,
                'valor_unitario' => $valor_unitario,
                'quantidade' => $this->quantidade,
                'valor_total' =>  $valor_total
            ]);

            $this->pedido->valor_itens = $this->pedido->valor_itens + $valor_total;
            $this->pedido->valor_total = $this->pedido->valor_total + $this->pedido->valor_frete + $valor_total;
            $this->pedido->save();

            DB::commit();

            $this->alert('success', 'Item adicionado!');
            $this->navegar("/pedidos/{$this->pedido->id}");
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->alert('error', 'Item não foi adicionado!');
        }
    }

    public function render()
    {
        return view('livewire.pedido.itens.create');
    }
}
