<?php

namespace App\Livewire\Produto;

use App\Models\Categoria;
use App\Models\Produto;
use App\Traits\Navegavel;
use Livewire\Component;

class ProdutoCreate extends Component
{
    use Navegavel;

    public $nome;
    public $valor;
    public $descricao;
    public $categoria_id;

    public function save()
    {
        Produto::create([
            'nome' => $this->nome,
            'valor' => $this->valor,
            'descricao' => $this->descricao,
            'categoria_id' => $this->categoria_id
        ]);
        return redirect()->to('/produtos');
    }

    public function render()
    {
        return view('livewire.produto.create', ['categorias' => Categoria::all()]);
    }
}
