<?php

namespace App\Livewire\Cliente;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ClienteIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public $termo = '';

    public function delete(int $id)
    {
        if (count(Pedido::where('cliente_id', $id)->get()) > 0) {
            $this->alert('error', 'Cliente possui pedidos!');
        } else {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();
            $this->alert('success', 'Cliente apagado!');
        }
    }

    public function render()
    {

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'telefone', 'label' => 'Telefone'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'bairro.nome', 'label' => 'Bairro'],
        ];

        $clientes = Cliente::with('bairro')->where('nome', 'like', "%{$this->termo}%")->get();

        return view('livewire.cliente.index', ['clientes' => $clientes, 'headers' => $headers]);
    }
}
