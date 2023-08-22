<?php

namespace App\Livewire\Categoria;

use App\Models\Categoria;
use App\Traits\Navegavel;
use Livewire\Component;

class CategoriaCreate extends Component
{
    use Navegavel;

    public $nome;

    public function save()
    {
        Categoria::create([
            'nome' => $this->nome
        ]);
        return redirect()->to('/categorias');
    }

    public function render()
    {
        return view('livewire.categoria.create');
    }
}
