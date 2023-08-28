<?php

namespace App\Livewire\Bairro;

use App\Models\Bairro;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class BairroCreate extends Component
{
    use Navegavel;
    use LivewireAlert;

    #[Rule('required')]
    public $nome;

    #[Rule('required|decimal:0,2')]
    public $frete;

    public function save()
    {
        Bairro::create($this->validate());
        $this->alert('success', 'Bairro criado com sucesso!');
        $this->dispatch('bairro-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.bairro.create');
    }
}
