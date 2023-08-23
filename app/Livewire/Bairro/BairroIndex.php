<?php

namespace App\Livewire\Bairro;

use App\Models\Bairro;
use App\Models\Cliente;
use App\Traits\Navegavel;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BairroIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public string $termo = '';

    public function delete(int $id)
    {
        if (count(Cliente::where('bairro_id', $id)->get()) > 0) {
            $this->alert('error', 'Bairro está sendo usado!');
        } else {
            $bairro = Bairro::findOrFail($id);
            $bairro->delete();
            $this->alert('success', 'Bairro apagado!');
        }
        // $this->authorize('delete', $post);

    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'frete', 'label' => 'Valor Frete'],
        ];

        $bairros = Bairro::where('nome', 'like', "%{$this->termo}%")->get();

        return view('livewire.bairro.index', ['bairros' => $bairros, 'headers' => $headers]);
    }
}
