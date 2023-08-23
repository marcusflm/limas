<?php

namespace App\Livewire\Produto;

use App\Models\Categoria;
use App\Models\Produto;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ProdutoEdit extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Produto $produto;

    #[Rule('required')]
    public $nome;

    #[Rule('required')]
    public $categoria_id;

    #[Rule('required|decimal:0,2')]
    public $valor;

    public $descricao;

    function mount()
    {
        $this->nome = $this->produto->nome;
        $this->categoria_id = $this->produto->categoria_id;
        $this->valor = $this->produto->valor;
        $this->descricao = $this->produto->descricao;
    }

    public function save()
    {
        if ($this->produto->update($this->validate())) {
            $this->flash('success', 'Produto alterado com sucesso!', [], '/produtos');
        } else {
            $this->flash('error', 'Produto não foi alterado!');
        }

        // return $this->redirect('/produtos', navigate: true);
    }

    public function render()
    {
        return view('livewire.produto.edit', [
            'categorias' => Categoria::all()
        ]);
    }
}
