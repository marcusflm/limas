<?php

namespace App\Livewire\Ingrediente;

use App\Models\Ingrediente;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class IngredienteCreate extends Component
{
    use LivewireAlert;

    #[Rule('required')]
    public $nome;

    public function save()
    {
        Ingrediente::create($this->validate());
        $this->alert('success', 'Ingrediente criado com sucesso!');
        $this->dispatch('ingrediente-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.ingrediente.create');
    }
}
