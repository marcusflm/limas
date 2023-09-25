<?php

namespace App\Livewire\Produto;

use App\Models\Produto;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ProdutoIndex extends Component
{
    use LivewireAlert;
    use Navegavel;

    public Produto $produto;

    public $termo = '';

    public bool $myModal = false;

    #[On('produto-edicao-concluida')]
    public function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function create()
    {
        unset($this->produto);
        $this->myModal = true;
    }

    public function delete(Produto $produto)
    {
        if ($produto->itens()->count()) {
            $this->alert('error', 'Produto está sendo usado!');

            return;
        }

        $produto->delete();
        $this->alert('success', 'Produto apagado!');
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'categoria.nome', 'label' => 'Categoria'],
            ['key' => 'valor', 'label' => 'Valor'],
            ['key' => 'descricao', 'label' => 'Descrição'],
        ];

        $produtos = Produto::with('categoria')
            ->where('nome', 'like', "%{$this->termo}%")
            ->orderBy('id', 'asc')
            ->get();

        return view('livewire.produto.index', ['produtos' => $produtos, 'headers' => $headers]);
    }
}
