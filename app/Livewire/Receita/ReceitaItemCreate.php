<?php

namespace App\Livewire\Receita;

use App\Models\Ingrediente;
use App\Models\IngredientesReceita;
use App\Models\Receita;
use App\Traits\Navegavel;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ReceitaItemCreate extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Receita $receita;

    #[Rule('required')]
    public $ingrediente_id = null;

    #[Rule('required')]
    public $receita_id = null;

    #[Rule('required')]
    public $quantidade = 0;

    public $observacao;

    public $ingredientes;

    public function mount()
    {
        $this->receita_id = $this->receita->id;
        $this->search();
    }

    public function search(string $value = '')
    {
        $this->ingredientes = Ingrediente::query()
            ->where('nome', 'like', "%{$value}%")
            ->take(5)
            ->get();
    }

    public function save()
    {
        $this->validate();

        $ingredienteJaAdicionado = $this->receita
            ->ingredientesReceita()
            ->where('ingrediente_id', $this->ingrediente_id)
            ->count();

        if ($ingredienteJaAdicionado) {
            $this->alert('error', 'Ingrediente já existe na compra!');
            return;
        }

        IngredientesReceita::create([
            'ingrediente_id' => $this->ingrediente_id,
            'quantidade' => $this->quantidade,
            'receita_id' => $this->receita_id,
            'observacao' => $this->observacao
        ]);

        $this->alert('success', 'Item adicionado!');
        $this->navegar("/receitas/{$this->receita->id}");
    }

    public function render()
    {
        return view('livewire.receita.itens.create');
    }
}
