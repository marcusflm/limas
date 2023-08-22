<?php

namespace App\Livewire\Bairro;

use App\Models\Bairro;
use App\Traits\Navegavel;
use Livewire\Component;

class BairroIndex extends Component
{
    use Navegavel;

    public string $termo = '';

    public function delete(int $id)
    {
        $bairro = Bairro::findOrFail($id);

        // $this->authorize('delete', $post);

        $bairro->delete();
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
