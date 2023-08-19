<?php

namespace App\Livewire;

use App\Models\Produto;
use Livewire\Component;

class Produtos extends Component
{
    public function cadastrar()
    {
        return redirect()->to('produtos/cadastrar');
    }
    public function render()
    {
        $produtos = Produto::with('categoria')->get();

        // dd($clientes);
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'categoria.nome', 'label' => 'Categoria'],
            ['key' => 'valor', 'label' => 'Valor'],
            ['key' => 'descricao', 'label' => 'Descrição']
        ];
        return view('livewire.produtos', ['produtos' => $produtos, 'headers' => $headers]);
    }
}
