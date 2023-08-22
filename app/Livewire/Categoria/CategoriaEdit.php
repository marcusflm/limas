<?php

namespace App\Livewire\Categoria;

use App\Models\Categoria;
use App\Traits\Navegavel;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CategoriaEdit extends Component
{
    use Navegavel;

    public Categoria $categoria;

    #[Rule('required')]
    public $nome;

    function mount()
    {
        $this->nome = $this->categoria->nome;
    }

    public function save()
    {
        $this->categoria->update($this->validate());

        return $this->redirect('/categorias', navigate: true);
    }

    public function render()
    {
        return view('livewire.categoria.edit');
    }
}
