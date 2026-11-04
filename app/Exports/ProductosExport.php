<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Producto;
use App\Models\Categoria;

class ProductosExport implements FromView
{
    protected $productos;

    public function __construct($productos)
    {
        $this->productos = $productos;
    }

    public function view(): View
    {
        $productos = Producto::select('id', 'nombre', 'precio', 'stock', 'categoria_id')->get();
        $categorias = Categoria::select('id', 'nombreCategoria')->get();

        return view('producto.export', [
            'productos' => $productos,
            'categorias' => $categorias,
        ]);
    }
}