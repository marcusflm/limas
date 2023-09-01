<?php

namespace App\Livewire\Receita;

use App\Models\IngredientesReceita;
use App\Models\Receita;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ReceitaShow extends Component
{
    public Receita $receita;

    public $ingredientesReceita;

    public $ingrediente;

    #[Rule('required')]
    public $ingrediente_id;

    #[Rule('required|decimal:0,2')]
    public $quantidade;

    public bool $myModal = false;

    #[On('receita-edicao-concluida')]
    function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function mount()
    {
        $this->ingredientesReceita = IngredientesReceita::with('ingrediente')->get();
    }

    public function delete(IngredientesReceita $ingrediente)
    {
        $ingrediente->delete();
        return redirect()->to("/receitas/{$this->receita->id}");
    }

    public function edit(IngredientesReceita $ingrediente)
    {
        $this->ingrediente = $ingrediente;
        $this->myModal = true;
    }

    public function render()
    {
        // $ingredientesReceita = IngredientesReceita::with('ingrediente')->where('receita_id', $this->receita->id)->get();

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'ingrediente.nome', 'label' => 'Ingrediente'],
            ['key' => 'quantidade', 'label' => 'Quantidade (g/ml)'],
        ];

        return view('livewire.receita.show')->with([
            'headers' => $headers,
        ]);
    }
}
