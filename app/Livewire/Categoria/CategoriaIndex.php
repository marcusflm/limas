<?php

namespace App\Livewire\Categoria;

use App\Models\Categoria;
use App\Traits\Navegavel;
use Livewire\Component;

class CategoriaIndex extends Component
{
    use Navegavel;

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
        ];

        return view('livewire.categoria.index', ['headers' => $headers, 'categorias' => Categoria::all()]);
    }
}
