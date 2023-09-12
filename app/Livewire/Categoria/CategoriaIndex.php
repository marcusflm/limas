<?php

namespace App\Livewire\Categoria;

use App\Models\Categoria;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoriaIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Categoria $categoria;

    public bool $myModal = false;

    #[On('categoria-edicao-concluida')]
    function fechaModal(): void
    {
        $this->myModal = false;
        $this->reset('categoria');
    }

    public function edit(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->myModal = true;
    }

    public function create()
    {
        $this->reset('categoria');
        $this->myModal = true;
    }

    public function delete(Categoria $categoria)
    {
        if ($categoria->produtos()->count()) {
            $this->alert('error', 'Categoria está sendo usada!');
            return;
        }

        $categoria->delete();
        $this->alert('success', 'Categoria apagada!');
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
        ];


        return view('livewire.categoria.index')->with([
            'headers' => $headers,
            'categorias' => Categoria::all()
        ]);
    }
}
