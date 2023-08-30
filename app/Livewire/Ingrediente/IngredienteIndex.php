<?php

namespace App\Livewire\Ingrediente;

use App\Models\Ingrediente;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class IngredienteIndex extends Component
{
    use LivewireAlert;

    public Ingrediente $ingrediente;

    public bool $myModal = false;

    public string $termo = '';

    #[On('ingrediente-edicao-concluida')]
    function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function edit(Ingrediente $ingrediente)
    {
        $this->ingrediente = $ingrediente;
        $this->myModal = true;
    }

    public function create()
    {
        unset($this->ingrediente);
        $this->myModal = true;
    }

    public function delete(Ingrediente $ingrediente)
    {
        if ($ingrediente->clientes()->count()) {
            $this->alert('error', 'Mercado está sendo usado!');
            return;
        }

        $ingrediente->delete();
        $this->alert('success', 'Ingrediente apagado!');
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
        ];

        return view('livewire.ingrediente.index')->with([
            'headers' => $headers,
            'ingredientes' => Ingrediente::all()
        ]);
    }
}
