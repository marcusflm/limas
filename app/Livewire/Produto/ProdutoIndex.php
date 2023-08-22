<?php

namespace App\Livewire\Produto;

use App\Models\Produto;
use App\Traits\Navegavel;
use Livewire\Component;

class ProdutoIndex extends Component
{
    use Navegavel;

    public $termo = '';

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'categoria.nome', 'label' => 'Categoria'],
            ['key' => 'valor', 'label' => 'Valor'],
            ['key' => 'descricao', 'label' => 'Descrição']
        ];

        $produtos = Produto::with('categoria')->where('nome', 'like', "%{$this->termo}%")->get();

        return view('livewire.produto.index', ['produtos' => $produtos, 'headers' => $headers]);
    }
}
