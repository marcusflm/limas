<?php

namespace App\Livewire\Produto;

use App\Models\Categoria;
use App\Models\Produto;
use App\Traits\Navegavel;
use Illuminate\Database\Eloquent\Collection;
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
    public $valor;

    #[Rule('required')]
    public $categoria_id;

    public $descricao;

    public Collection $categorias;

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
        if (Produto::create($this->validate())) {
            $this->flash('success', 'Produto criado com sucesso!', [], '/produtos');
        } else {
            $this->flash('error', 'Produto não foi criado!', [], '/produtos');
        }
    }

    public function render()
    {
        return view('livewire.produto.create');
    }
}
