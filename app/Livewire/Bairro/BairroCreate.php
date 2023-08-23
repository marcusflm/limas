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

    public Bairro $bairro;

    #[Rule('required')]
    public $nome;

    #[Rule('required|decimal:0,2')]
    public $frete;

    public function save()
    {
        if (Bairro::create($this->validate())) {
            $this->flash('success', 'Bairro criado com sucesso!', [], '/bairros');
        } else {
            $this->flash('error', 'Bairro não foi criado!');
        }
    }

    public function render()
    {
        return view('livewire.bairro.create');
    }
}
