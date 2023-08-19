<?php

namespace App\Livewire;

use App\Models\Bairro;
use App\Models\Cliente;
use Livewire\Component;

class CadastraCliente extends Component
{
    public $nome;
    public $telefone;
    public $email;
    public $bairro_id;

    public function save()
    {
        Cliente::create([
            'nome' => $this->nome,
            'telefone' => $this->telefone,
            'email' => $this->email,
            'bairro_id' => $this->bairro_id
        ]);
        return redirect()->to('/clientes');
    }

    public function render()
    {
        $bairros = Bairro::all();
        return view('livewire.cadastra-cliente', ['bairros' => $bairros]);
    }
}
