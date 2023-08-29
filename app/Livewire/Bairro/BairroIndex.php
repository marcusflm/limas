<?php

namespace App\Livewire\Bairro;

use App\Models\Bairro;
use App\Traits\Navegavel;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;

class BairroIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Bairro $bairro;

    public bool $myModal = false;

    public string $termo = '';

    #[On('bairro-edicao-concluida')]
    function fechaModal(): void
    {
        $this->myModal = false;
    }

    public function edit(Bairro $bairro)
    {
        $this->bairro = $bairro;
        $this->myModal = true;
    }

    public function create()
    {
        unset($this->bairro);
        $this->myModal = true;
    }

    public function delete(Bairro $bairro)
    {
        if ($bairro->clientes()->count()) {
            $this->alert('error', 'Bairro está sendo usado!');
            return;
        }

        $bairro->delete();
        $this->alert('success', 'Bairro apagado!');
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'frete', 'label' => 'Valor Frete'],
        ];

        $bairros = Bairro::where('nome', 'like', "%{$this->termo}%")->get();

        return view('livewire.bairro.index')->with([
            'bairros' => $bairros,
            'headers' => $headers
        ]);
    }
}
