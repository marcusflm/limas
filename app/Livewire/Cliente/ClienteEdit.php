<?php

namespace App\Livewire\Cliente;

use App\Models\Bairro;
use App\Models\Cliente;
use App\Traits\Navegavel;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ClienteEdit extends Component
{
    use Navegavel;

    public Cliente $cliente;

    #[Rule('required')]
    public $nome;

    #[Rule('required|min:10')]
    public $telefone;

    #[Rule('required|email')]
    public $email;

    #[Rule('required')]
    public $bairro_id;

    function mount()
    {
        $this->nome = $this->cliente->nome;
        $this->telefone = $this->cliente->telefone;
        $this->email = $this->cliente->email;
        $this->bairro_id = $this->cliente->bairro_id;
    }

    function save()
    {
        // dd($this);
        $this->cliente->update($this->validate());

        return redirect()->to('/clientes');
    }


    public function render()
    {
        return view('livewire.cliente.edit', ['bairros' => Bairro::all()]);
    }
}
