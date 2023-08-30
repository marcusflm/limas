<?php

namespace App\Livewire\Produto;

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
        $this->produto->fresh()->update($this->validate());
        $this->alert('success', 'Produto alterado com sucesso!');
        $this->dispatch('produto-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.produto.edit');
    }
}
