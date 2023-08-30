<?php

namespace App\Livewire\Mercado;

use App\Models\Mercado;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Rule;
use Livewire\Component;

class MercadoEdit extends Component
{
    use LivewireAlert;

    #[Reactive]
    public Mercado $mercado;

    #[Rule('required')]
    public $nome;

    function boot()
    {
        $this->nome = $this->mercado->nome;
    }

    public function save()
    {
        $this->mercado->fresh()->update($this->validate());
        $this->alert('success', 'Mercado alterado com sucesso!');
        $this->dispatch('mercado-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.mercado.edit');
    }
}
