<?php

namespace App\Livewire\Compra;

use App\Models\Compra;
use App\Models\ItensCompra;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CompraShow extends Component
{
    public Compra $compra;

    public $itensCompra;

    public $item;

    #[Rule('decimal:0,2')]
    public $valor_desconto;

    #[Rule('decimal:0,2')]
    public $valor_itens;

    #[Rule('decimal:0,2')]
    public $valor_total;

    public $observacao;

    public bool $myModal = false;

    #[On('compra-edicao-concluida')]
    function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function mount()
    {
        $this->valor_total = $this->compra->valor_total;

        $this->itensCompra = ItensCompra::with('compra')->get();
    }

    public function delete(ItensCompra $item)
    {
        try {
            DB::beginTransaction();

            $valor_total_itens = ($item->valor_unitario * $item->quantidade);
            $item->delete();

            if ($this->compra->itensCompra()->count() > 0) {
                $this->compra->valor_total = $this->compra->valor_total - $valor_total_itens;
            } else {
                $this->compra->valor_total = 0;
            }
            $this->compra->save();

            DB::commit();
            return redirect()->to("/compras/{$this->compra->id}");
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->alert('error', 'Erro ao deletar item!');
        }
    }

    public function edit(ItensCompra $item)
    {
        $this->item = $item;
        $this->myModal = true;
    }

    public function render()
    {
        $itensCompra = ItensCompra::with('ingrediente')->where('compra_id', $this->compra->id)->get();

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'ingrediente.nome', 'label' => 'Ingrediente'],
            ['key' => 'quantidade', 'label' => 'Quantidade'],
            ['key' => 'peso', 'label' => 'Peso (g/ml)'],
            ['key' => 'valor_unitario', 'label' => 'Valor unitário'],
        ];

        return view('livewire.compra.show')->with([
            'headers' => $headers,
            'itensCompra' => $itensCompra
        ]);
    }
}
