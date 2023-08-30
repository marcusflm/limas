<?php

namespace App\Livewire\Ingrediente;

use App\Models\Ingrediente;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Rule;
use Livewire\Component;

class IngredienteEdit extends Component
{
    use LivewireAlert;

    #[Reactive]
    public Ingrediente $ingrediente;

    #[Rule('required')]
    public $nome;

    function boot()
    {
        $this->nome = $this->ingrediente->nome;
    }

    public function save()
    {
        $this->ingrediente->fresh()->update($this->validate());
        $this->alert('success', 'Ingrediente alterado com sucesso!');
        $this->dispatch('ingrediente-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.ingrediente.edit');
    }
}
