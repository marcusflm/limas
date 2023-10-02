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
    use LivewireAlert;
    use Navegavel;

    public Cliente $cliente;

    public $bairros;

    #[Rule('required')]
    public $nome;

    public $telefone;

    public $email;

    #[Rule('required')]
    public $bairro_id;

    public function boot()
    {
        $this->nome = $this->cliente->nome;
        $this->telefone = $this->cliente->telefone;
        $this->email = $this->cliente->email;
        $this->bairro_id = $this->cliente->bairro_id;
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

        $this->cliente->fresh()->update($this->validate());
        $this->alert('success', 'Cliente alterado com sucesso!');
        $this->dispatch('cliente-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.cliente.edit', ['bairros' => Bairro::all()]);
    }
}
