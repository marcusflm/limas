<?php

namespace App\Livewire\Cliente;

use App\Models\Bairro;
use App\Models\Cliente;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ClienteCreate extends Component
{
    use LivewireAlert;
    use Navegavel;

    #[Rule('required')]
    public $nome;

    public $telefone;

    public $email;

    #[Rule('required')]
    public $bairro_id;

    public $bairros;

    public function mount()
    {
        $this->search();
    }

    public function search(string $value = '')
    {
        $this->bairros = Bairro::query()
            ->where('nome', 'like', "%{$value}%")
            ->take(5)
            ->get();
    }

    public function save()
    {
        $this->telefone = preg_replace('/[^0-9]/', '', $this->telefone);

        if (strlen($this->telefone) > 11) {
            $this->telefone = substr($this->telefone, 0, 11);
        }

        $cliente = Cliente::create($this->validate());

        if ($this->telefone) {
            $cliente->telefone = $this->telefone;
            $cliente->save();
        }

        if ($this->email) {
            $cliente->email = $this->email;
            $cliente->save();
        }
        $this->alert('success', 'Cliente criado com sucesso!');
        $this->dispatch('cliente-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.cliente.create');
    }
}
