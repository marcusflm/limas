<?php

namespace App\Livewire\Lote;

use App\Models\Compra;
use App\Models\ItensCompra;
use App\Models\Lote;
use App\Models\Produto;
use App\Models\Receita;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Rule;
use Livewire\Component;

class LoteCreate extends Component
{
    public Lote $lote;

    #[Rule('required')]
    public $produto_id;

    #[Rule('required')]
    public $compra_id;

    #[Rule('required')]
    public $quantidade;

    public $produtos;
    public $compras;

    public function mount()
    {
        $this->search();
        $this->search2();
    }

    public function search(string $value = '')
    {
        $this->produtos = Produto::whereHas('receita')
            ->where('nome', 'like', "%{$value}%")
            ->take(5)
            ->get();
    }

    public function search2(string $value = '')
    {
        $this->compras = Compra::query()
            ->where('id', 'like', "%{$value}%")
            ->take(5)
            ->get();
    }

    public function save()
    {
        $this->validate();

        $custo_lote = $this->calculaCustoLote($this->produto_id, $this->compra_id);

        $custo_unitario = $custo_lote / $this->quantidade;

        Lote::create([
            'produto_id' => $this->produto_id,
            'compra_id' => $this->compra_id,
            'quantidade' => $this->quantidade,
            'custo_unitario' => $custo_unitario,
            'custo_lote' => $custo_lote
        ]);

        return redirect()->to("/lotes");
    }

    public function calculaCustoLote($produto_id, $compra_id)
    {
        $custo = 0;
        $receita = Receita::where('produto_id', $produto_id)->with('ingredientesReceita')->first();
        $ingredientes = $receita->ingredientesReceita;
        $itensCompra = ItensCompra::where('compra_id', $compra_id)->get();
        foreach ($itensCompra as $item) {
            foreach ($ingredientes as $ingrediente) {
                if ($ingrediente->ingrediente_id == $item->ingrediente_id) {
                    if (($item->quantidade * $item->peso) >= $ingrediente->quantidade) {
                        $custo = $custo + (($ingrediente->quantidade / $item->peso) * $item->valor_unitario);
                    }
                }
            }
        }
        return $custo;
    }

    public function render()
    {
        return view('livewire.lote.create');
    }
}
