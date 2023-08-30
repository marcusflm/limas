<?php

namespace App\Livewire\Mercado;

use App\Models\Mercado;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class MercadoIndex extends Component
{
    use LivewireAlert;

    public Mercado $mercado;

    public bool $myModal = false;

    public string $termo = '';

    #[On('mercado-edicao-concluida')]
    function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function edit(Mercado $mercado)
    {
        $this->mercado = $mercado;
        $this->myModal = true;
    }

    public function create()
    {
        unset($this->mercado);
        $this->myModal = true;
    }

    public function delete(Mercado $mercado)
    {
        if ($mercado->clientes()->count()) {
            $this->alert('error', 'Mercado está sendo usado!');
            return;
        }

        $mercado->delete();
        $this->alert('success', 'Mercado apagado!');
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
        ];

        $mercados = Mercado::where('nome', 'like', "%{$this->termo}%")->get();


        return view('livewire.mercado.index')->with([
            'headers' => $headers,
            'mercados' => $mercados
        ]);
    }
}
