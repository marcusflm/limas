<?php

namespace App\Livewire\Produto;

use App\Models\Categoria;
use App\Models\Produto;
use App\Traits\Navegavel;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ProdutoCreate extends Component
{
    use Navegavel;

    #[Rule('required')]
    public $nome;

    #[Rule('required|decimal:0,2')]
    public $valor;

    #[Rule('required')]
    public $descricao;

    #[Rule('required')]
    public $categoria_id;

    public function save()
    {
        if (Produto::create($this->validate())) {
            $this->flash('success', 'Produto criado com sucesso!', [], '/produtos');
        } else {
            $this->flash('error', 'Produto não foi criado!');
        }
    }

    public function render()
    {
        return view('livewire.produto.create', ['categorias' => Categoria::all()]);
    }
}
