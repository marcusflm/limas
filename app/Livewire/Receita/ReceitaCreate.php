<?php

namespace App\Livewire\Receita;

use App\Models\Produto;
use App\Models\Receita;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ReceitaCreate extends Component
{
    public Receita $receita;

    #[Rule('required')]
    public $produto_id;

    public $produtos;

    public function mount()
    {
        $this->search();
    }

    public function search(string $value = '')
    {
        $this->produtos = Produto::query()
            ->where('nome', 'like', "%{$value}%")
            ->take(5)
            ->get();
    }

    public function save()
    {
        $receita = receita::create($this->validate());

        return redirect()->to("receitas/{$receita->id}");
    }

    public function render()
    {
        return view('livewire.receita.create');
    }
}
