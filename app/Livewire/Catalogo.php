<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CategoriaModel;

class Catalogo extends Component
{
    public function render()
    {
        $categorias = CategoriaModel::with('productos')->get();
        return view('livewire.catalogo',[
            'categorias' => $categorias
        ]);
    }
}
