<?php

namespace App\Livewire\Categoria;

use App\Models\Categoria;
use App\Traits\Navegavel;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CategoriaCreate extends Component
{
    use Navegavel;

    #[Rule('required')]
    public $nome;

    public function save()
    {
        if (Categoria::create($this->validate())) {
            $this->flash('success', 'Categoria criada com sucesso!', [], '/categorias');
        } else {
            $this->flash('error', 'Categoria não foi criada!');
        }
    }

    public function render()
    {
        return view('livewire.categoria.create');
    }
}
