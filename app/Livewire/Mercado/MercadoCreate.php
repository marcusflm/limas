<?php

namespace App\Livewire\Mercado;

use App\Models\Mercado;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class MercadoCreate extends Component
{
    use LivewireAlert;

    #[Rule('required')]
    public $nome;

    public function save()
    {
        Mercado::create($this->validate());
        $this->alert('success', 'Mercado criado com sucesso!');
        $this->dispatch('mercado-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.mercado.create');
    }
}
