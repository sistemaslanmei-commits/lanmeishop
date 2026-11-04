<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductoModel;
use App\Models\CategoriaModel;

class ProductTable extends Component
{
    
    public $products, $categories, $nombre, $imagen, $precio, $stock, $categoria_id;
    public $selectedProduct = [];
    public $showEditModal = false;

    public function mount()
    {
        $this->categories = CategoriaModel::all();
        $this->products = ProductoModel::with('categoria')->get();
    }

    public function render()
    {
        return view('livewire.product-table');
    }

    public function edit($id)
    {
        // Cargar los detalles del producto desde la base de datos
        $this->selectedProduct = ProductoModel::find($id);

        // Mostrar el modal de edición después de cargar los datos
        $this->showEditModal = true;     
    }

    public function create()
    {
        // Código para crear el producto
        ProductoModel::create([
            'nombre' => $this->nombre,
            'imagen' => $this->imagen,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'categoria_id' => $this->categoria_id,
        ]);

        $this->resetFields(); // Limpia los campos después de la creación
    }

    public function update()
    {
        // Código para actualizar el producto
        $this->selectedProduct->update([
            'nombre' => $this->nombre,
            'imagen' => $this->imagen,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'categoria_id' => $this->categoria_id,
        ]);

        $this->resetFields(); // Limpia los campos después de la actualización
        $this->selectedProduct = null;
        $this->showEditModal = false;
    }

    public function delete($id)
    {
        // Código para eliminar el producto
        ProductoModel::find($id)->delete();
    }

    private function resetFields()
    {
        $this->nombre = '';
        $this->imagen = '';
        $this->precio = '';
        $this->stock = '';
        $this->categoria_id = '';
    }

}