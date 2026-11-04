<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductoModel;
class Carrusel extends Component

{

    public function render()
    {
        $productos = ProductoModel::all();
        return view('livewire.carrusel', compact('productos'));
    }
}
