<?php

namespace App\Livewire;

use App\Models\Categoria;
use Livewire\Component;

class CadastraCategoria extends Component
{
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
        return view('livewire.cadastra-categoria');
    }
}
