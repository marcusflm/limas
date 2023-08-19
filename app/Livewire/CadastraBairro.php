<?php

namespace App\Livewire;

use App\Models\Bairro;
use Livewire\Component;

class CadastraBairro extends Component
{
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
        return view('livewire.cadastra-bairro');
    }
}
