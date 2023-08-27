<?php

namespace App\Livewire\Produto;

use App\Models\Produto;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProdutoIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Produto $produto;

    public $termo = '';

    public bool $myModal = false;

    public function create()
    {
        unset($this->produto);
        $this->myModal = true;
    }

    public function delete(Produto $produto)
    {
        if ($produto->itens()->count()) {
            $this->alert('error', 'Produto está sendo usado!');
        } else {
            $produto->delete();
            $this->alert('success', 'Produto apagado!');
        }
        // $this->authorize('delete', $post);

    }

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
