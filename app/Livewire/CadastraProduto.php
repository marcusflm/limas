<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Produto;
use Livewire\Component;

class CadastraProduto extends Component
{
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
        return view('livewire.cadastra-produto', ['categorias' => Categoria::all()]);
    }
}
