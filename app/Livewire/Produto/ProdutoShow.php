<?php

namespace App\Livewire\Produto;

use App\Models\Categoria;
use App\Models\ItensPedido;
use App\Models\Produto;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ProdutoShow extends Component
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

    public $total_unidades_vendidas = 0;

    public $valor_total_unidades_vendidas = 0;

    public bool $myModal = false;

    function mount()
    {
        $this->nome = $this->produto->nome;
        $this->categoria_id = $this->produto->categoria_id;
        $this->valor = $this->produto->valor;
        $this->descricao = $this->produto->descricao;

        $itensVendidos = ItensPedido::query()
            ->with('pedido')
            ->where('produto_id', $this->produto->id)
            ->get();

        foreach ($itensVendidos as $itemVendido) {
            if ($itemVendido->pedido->status_pedido_id == 2 && $itemVendido->pedido->status_pagamento_id == 2) {
                $this->total_unidades_vendidas = $this->total_unidades_vendidas + $itemVendido->quantidade;
                $this->valor_total_unidades_vendidas = $this->valor_total_unidades_vendidas + $itemVendido->valor_total;
            }
        }
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
        return view('livewire.produto.show', [
            'categorias' => Categoria::all()
        ]);
    }
}
