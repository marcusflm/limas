<?php

namespace App\Livewire\Produto;

use App\Models\ItensPedido;
use App\Models\Produto;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProdutoIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public $termo = '';

    public function delete(int $id)
    {
        if (count(ItensPedido::where('produto_id', $id)->get()) > 0) {
            $this->alert('error', 'Produto está sendo usado!');
        } else {
            $produto = Produto::findOrFail($id);
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
