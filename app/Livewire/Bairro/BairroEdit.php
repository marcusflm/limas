<?php

namespace App\Livewire\Bairro;

use App\Models\Bairro;
use App\Traits\Navegavel;
use Livewire\Attributes\Rule;
use Livewire\Component;

class BairroEdit extends Component
{
    use Navegavel;

    public Bairro $bairro;

    #[Rule('required')]
    public $nome;

    #[Rule('required|decimal:0,2')]
    public $frete;

    function mount()
    {
        $this->nome = $this->bairro->nome;
        $this->frete = $this->bairro->frete;
    }

    public function save()
    {
        $this->bairro->update($this->validate());

        return $this->redirect('/bairros', navigate: true);
    }

    public function render()
    {
        return view('livewire.bairro.edit');
    }
}
