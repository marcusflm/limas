<?php

namespace App\Livewire\Categoria;

use App\Models\Categoria;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CategoriaEdit extends Component
{
    use Navegavel;
    use LivewireAlert;

    public Categoria $categoria;

    #[Rule('required')]
    public $nome;

    function mount()
    {
        $this->nome = $this->categoria->nome;
    }

    public function save()
    {
        if ($this->categoria->update($this->validate())) {
            $this->flash('success', 'Categoria alterada com sucesso!', [], '/categorias');
        } else {
            $this->flash('error', 'Categoria não foi alterada!');
        }
        // return $this->redirect('/categorias', navigate: true);
    }

    public function render()
    {
        return view('livewire.categoria.edit');
    }
}
