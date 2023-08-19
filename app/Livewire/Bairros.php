<?php

namespace App\Livewire;

use App\Models\Bairro;
use Livewire\Component;

class Bairros extends Component
{
    public function cadastrar()
    {
        return redirect()->to('/bairros/cadastrar');
    }

    public function navegar(int $bairro_id)
    {
        // dump($bairro_id);
        return redirect()->to("/bairros/{$bairro_id}");
        //dd($bairros->toArray())
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'frete', 'label' => 'Valor Frete'],
        ];
        $bairros = Bairro::all();
        return view('livewire.bairros', ['bairros' => $bairros, 'headers' => $headers]);
    }
}
