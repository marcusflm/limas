<?php

namespace App\Livewire;

use App\Models\Categoria;
use Livewire\Component;

class Categorias extends Component
{
    public function cadastrar()
    {
        return redirect()->to('categorias/cadastrar');
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
        ];
        $categorias = Categoria::all();
        return view('livewire.categorias', ['categorias' => $categorias, 'headers' => $headers]);
    }
}
