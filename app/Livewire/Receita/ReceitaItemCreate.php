<?php

namespace App\Livewire\Receita;

use App\Models\Ingrediente;
use Livewire\Component;

class ReceitaItemCreate extends Component
{
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

    public function render()
    {
        return view('livewire.receita.itens.create');
    }
}
