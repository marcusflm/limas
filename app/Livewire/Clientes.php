<?php

namespace App\Livewire;

use App\Models\Cliente;
use Livewire\Component;

class Clientes extends Component
{
    public function cadastrar()
    {
        return redirect()->to('/clientes/cadastrar');
    }

    public function render()
    {
        $clientes = Cliente::with('bairro')->get();

        // dd($clientes);
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'telefone', 'label' => 'Telefone'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'bairro.nome', 'label' => 'Bairro'],
        ];
        return view('livewire.clientes', ['clientes' => $clientes, 'headers' => $headers]);
    }
}
