<?php

namespace App\Livewire\Categoria;

use App\Models\Categoria;
use App\Models\Produto;
use App\Traits\Navegavel;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CategoriaIndex extends Component
{
    use Navegavel;
    use LivewireAlert;

    public function delete(int $id)
    {
        if (count(Produto::where('categoria_id', $id)->get()) > 0) {
            $this->alert('error', 'Categoria está sendo usada!');
        } else {
            $categoria = Categoria::findOrFail($id);
            $categoria->delete();
            $this->alert('success', 'Categoria apagada!');
        }
    }

    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nome', 'label' => 'Nome'],
        ];

        return view('livewire.categoria.index', ['headers' => $headers, 'categorias' => Categoria::all()]);
    }
}
