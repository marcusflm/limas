<?php

namespace App\Livewire\Bairro;

use App\Models\Bairro;
use App\Traits\Navegavel;
use Livewire\Component;

class BairroCreate extends Component
{
    use Navegavel;

    public $nome;
    public $frete;

    public function save()
    {
        Bairro::create([
            'nome' => $this->nome,
            'frete' => $this->frete
        ]);
        return redirect()->to('/bairros');
    }

    public function render()
    {
        return view('livewire.bairro.create');
    }
}
