<?php

namespace App\Livewire\Produto;

use App\Models\Produto;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ProdutoEdit extends Component
{
    use LivewireAlert;
    use Navegavel;

    public Produto $produto;

    #[Rule('required')]
    public $nome;

    #[Rule('required')]
    public $categoria_id;

    #[Rule('required|decimal:0,2')]
    public $valor;

    public $descricao;

    public function mount()
    {
        $this->nome = $this->produto->nome;
        $this->categoria_id = $this->produto->categoria_id;
        $this->valor = $this->produto->valor;
        $this->descricao = $this->produto->descricao;
    }

    public function save()
    {
        $this->produto->fresh()->update($this->validate());
        $this->produto->descricao = $this->descricao;
        $this->produto->update();
        $this->dispatch('produto-edicao-concluida');
        $this->flash('success', 'Produto alterado!', [], '/produtos/'.$this->produto->id);
        // $this->navegar('/produtos/'.$this->produto->id);
    }

    public function render()
    {
        return view('livewire.produto.edit');
    }
}
