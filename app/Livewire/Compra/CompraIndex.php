<?php

namespace App\Livewire\Compra;

use App\Models\Compra;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class CompraIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public bool $myModal = false;

    #[On('pedido-edicao-concluida')]
    function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function delete(Compra $compra)
    {
        $compra->delete();
        $this->alert('success', 'compra apagado!');
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'data_compra', 'label' => 'Data compra'],
            ['key' => 'mercado.nome', 'label' => 'Mercado'],
            ['key' => 'valor_total', 'label' => 'Total']
        ];

        $compras = Compra::with('mercado')->get();

        return view('livewire.compra.index')->with([
            'headers' => $headers,
            'compras' => $compras
        ]);
    }
}
