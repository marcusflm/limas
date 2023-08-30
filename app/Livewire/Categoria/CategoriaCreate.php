<?php

namespace App\Livewire\Categoria;

use App\Models\Categoria;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CategoriaCreate extends Component
{
    use Navegavel;
    use LivewireAlert;

    #[Rule('required')]
    public $nome;

    public function save()
    {
        Categoria::create($this->validate());
        $this->alert('success', 'Categoria criada com sucesso!');
        unset($this->nome);
        $this->dispatch('categoria-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.categoria.create');
    }
}
