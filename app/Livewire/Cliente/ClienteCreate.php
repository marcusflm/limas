<?php

namespace App\Livewire\Cliente;

use App\Models\Bairro;
use App\Models\Cliente;
use App\Traits\Navegavel;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ClienteCreate extends Component
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

    public function save()
    {
        if (Cliente::create($this->validate())) {
            $this->flash('success', 'Cliente criado com sucesso!', [], '/clientes');
        } else {
            $this->flash('error', 'Cliente não foi criado!');
        }
    }

    public function render()
    {
        return view('livewire.cliente.create', ['bairros' => Bairro::all()]);
    }
}
