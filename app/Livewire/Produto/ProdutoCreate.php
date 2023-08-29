<?php

namespace App\Livewire\Produto;

use App\Models\Categoria;
use App\Models\Produto;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ProdutoCreate extends Component
{
    use Navegavel;
    use LivewireAlert;

    #[Rule('required')]
    public $nome;

    #[Rule('required|decimal:0,2')]
    public $valor = 0;

    #[Rule('required')]
    public $categoria_id;

    public $descricao;

    public $categorias;

    public function mount()
    {
        $this->search();
    }

    public function search(string $value = '')
    {
        $this->categorias = Categoria::query()
            ->where('nome', 'like', "%{$value}%")
            ->take(5)
            ->get();
    }

    public function save()
    {
        Produto::create($this->validate());
        $this->alert('success', 'Produto criado com sucesso!');
        unset(
            $this->nome,
            $this->valor,
            $this->categoria_id,
            $this->descricao
        );
        $this->dispatch('produto-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.produto.create');
    }
}
