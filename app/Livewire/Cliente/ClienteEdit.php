<?php

namespace App\Livewire\Cliente;

use App\Models\Bairro;
use App\Models\Cliente;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ClienteEdit extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Cliente $cliente;

    #[Rule('required')]
    public $nome;

    #[Rule('required|min:10')]
    public $telefone;

    #[Rule('required|email')]
    public $email;

    #[Rule('required')]
    public $bairro_id;

    public bool $myModal = false;

    function mount()
    {
        $this->nome = $this->cliente->nome;
        $this->telefone = $this->cliente->telefone;
        $this->email = $this->cliente->email;
        $this->bairro_id = $this->cliente->bairro_id;
    }

    public function save()
    {
        $this->telefone = preg_replace("/[^0-9]/", "", $this->telefone);

        if (strlen($this->telefone) > 11) {
            $this->telefone = substr($this->telefone, 1, 11);
        }

        if ($this->cliente->update($this->validate())) {
            $this->flash('success', 'Cliente alterado com sucesso!', [], "/clientes/{$this->cliente->id}");
        } else {
            $this->flash('error', 'Cliente não foi alterado!');
        }
    }

    public function render()
    {
        return view('livewire.cliente.edit', ['bairros' => Bairro::all()]);
    }
}
