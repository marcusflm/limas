<?php

namespace App\Livewire\Cliente;

use App\Models\Bairro;
use App\Models\Cliente;
use App\Traits\Navegavel;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ClienteCreate extends Component
{
    use Navegavel;
    use LivewireAlert;

    #[Rule('required')]
    public $nome;

    #[Rule('required|min:10')]
    public $telefone;

    #[Rule('required|email')]
    public $email;

    #[Rule('required')]
    public $bairro_id;

    public $bairros;

    public $extract_phone_number_pattern = "/\\+?[1-9][0-9]{7,14}/";

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
        $this->telefone = preg_replace("/[^0-9]/", "", $this->telefone);

        if (strlen($this->telefone) > 11) {
            $this->telefone = substr($this->telefone, 1, 11);
        }

        if (Cliente::create($this->validate())) {
            $this->flash('success', 'Cliente criado com sucesso!', [], '/clientes');
        } else {
            $this->flash('error', 'Cliente não foi criado!', [], '/clientes');
        }
    }

    public function render()
    {
        return view('livewire.cliente.create', ['bairros' => Bairro::all()]);
    }
}
