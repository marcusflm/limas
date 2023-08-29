<?php

namespace App\Livewire\Categoria;

use App\Models\Categoria;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CategoriaEdit extends Component
{
    use Navegavel;
    use LivewireAlert;

    #[Reactive]
    public Categoria $categoria;

    #[Rule('required')]
    public $nome;

    function boot()
    {
        $this->nome = $this->categoria->nome;
    }

    public function save()
    {
        $this->categoria->fresh()->update($this->validate());
        $this->alert('success', 'Categoria alterada com sucesso!');
        $this->dispatch('categoria-edicao-concluida');
    }

    public function render()
    {
        return view('livewire.categoria.edit');
    }
}
