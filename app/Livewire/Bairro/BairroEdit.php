<?php

namespace App\Livewire\Bairro;

use App\Models\Bairro;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Rule;
use Livewire\Component;

class BairroEdit extends Component
{
    use Navegavel;
    use LivewireAlert;

    #[Reactive]
    public Bairro $bairro;

    #[Rule('required')]
    public $nome;

    #[Rule('required|decimal:0,2')]
    public $frete;

    function boot()
    {
        $this->nome = $this->bairro->nome;
        $this->frete = $this->bairro->frete;
    }

    public function save()
    {
        $this->bairro->fresh()->update($this->validate());
        $this->alert('success', 'Bairro alterado com sucesso!');
        $this->dispatch('bairro-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.bairro.edit');
    }
}
