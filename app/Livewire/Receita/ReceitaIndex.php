<?php

namespace App\Livewire\Receita;

use App\Models\Receita;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ReceitaIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public bool $myModal = false;

    #[On('receita-edicao-concluida')]
    function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function delete(Receita $receita)
    {
        $receita->delete();
        $this->alert('success', 'Receita apagada!');
    }
    public function render()
    {
        $receitas = Receita::with('produtos')->get();

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'produto.nome', 'label' => 'Data compra']
        ];

        return view('livewire.receita.index')->with([
            'headers' => $headers,
            'receitas' => $receitas
        ]);
    }
}
