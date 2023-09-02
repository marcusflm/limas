<?php

namespace App\Livewire\Lote;

use App\Models\Lote;
use Livewire\Attributes\On;
use Livewire\Component;

class LoteIndex extends Component
{
    public bool $myModal = false;

    #[On('lote-edicao-concluida')]
    function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function delete(Lote $lote)
    {
        $lote->delete();
        $this->alert('success', 'Lote apagado!');
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'produto.nome', 'label' => 'Produto'],
            ['key' => 'compra_id', 'label' => 'Compra'],
            ['key' => 'quantidade', 'label' => 'Quantidade por lote'],
            ['key' => 'custo_unitario', 'label' => 'Custo unitário'],
            ['key' => 'custo_lote', 'label' => 'Custo lote']
        ];

        $lotes = Lote::with('produto')->get();

        return view('livewire.lote.index')->with([
            'headers' => $headers,
            'lotes' => $lotes
        ]);
    }
}
