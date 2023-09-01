<?php

namespace App\Livewire\Compra;

use App\Models\Compra;
use App\Models\Ingrediente;
use App\Models\ItensCompra;
use App\Traits\Navegavel;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CompraItemCreate extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Compra $compra;

    #[Rule('required')]
    public $ingrediente_id = null;

    #[Rule('required')]
    public $valor_unitario;

    #[Rule('required')]
    public $peso;

    public $quantidade = 1;

    public $ingredientes;

    public function mount()
    {
        $this->search();
    }

    public function search(string $value = '')
    {
        $this->ingredientes = Ingrediente::query()
            ->where('nome', 'like', "%{$value}%")
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

        $ingredienteJaAdicionado = $this->compra
            ->itenscompra()
            ->where('ingrediente_id', $this->ingrediente_id)
            ->count();

        if ($ingredienteJaAdicionado) {
            $this->alert('error', 'Ingrediente já existe na compra!');
            return;
        }

        try {
            DB::beginTransaction();

            ItensCompra::create([
                'compra_id' => $this->compra->id,
                'ingrediente_id' => $this->ingrediente_id,
                'valor_unitario' => $this->valor_unitario,
                'quantidade' => $this->quantidade,
                'peso' => $this->peso,
                'valor_total' => $this->valor_unitario * $this->quantidade
            ]);

            $this->compra->valor_total = $this->compra->valor_total + ($this->valor_unitario * $this->quantidade);
            $this->compra->save();

            DB::commit();

            $this->alert('success', 'Item adicionado!');
            $this->navegar("/compras/{$this->compra->id}");
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->alert('error', 'Item não foi adicionado!');
        }
    }

    public function render()
    {
        return view('livewire.compra.itens.create');
    }
}
