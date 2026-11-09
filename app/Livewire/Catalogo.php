<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class Catalogo extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $categoria_id = null; // null = Mostrar todas las categorías
    public $search = '';
    public $perPage = 12; // 12 productos por página devueltos por MySQL

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function seleccionarCategoria($id = null)
    {
        $this->categoria_id = $id;
        $this->resetPage();
    }

    public function render()
    {
        // 1. Obtener categorías para la barra lateral de navegación
        $categorias = Categoria::orderBy('nombreCategoria', 'asc')->get();

        // 2. Subconsulta para Productos Locales
        $localesQuery = DB::table('productos')
            ->select('id',DB::raw("NULL as sku"), 'nombre', 'precio', 'imagen', 'categoria_id', 'enlace', 'enlaceVea');

        // 3. Subconsulta para Productos de Deltron
        $deltronQuery = DB::table('deltron_productos')
            ->select('id','sku', 'nombre', 'precio', 'imagen', 'categoria_id', 'enlace', 'enlaceVea');

        // 4. Aplicar Filtro de Categoría en MySQL (Lógica DigiGrow)
        if ($this->categoria_id) {
            $localesQuery->where('categoria_id', $this->categoria_id);
            $deltronQuery->where('categoria_id', $this->categoria_id);
        }

        // 5. Aplicar Buscador por Nombre en MySQL
        if (!empty($this->search)) {
            $term = '%' . trim($this->search) . '%';
            $localesQuery->where('nombre', 'like', $term);
            $deltronQuery->where('nombre', 'like', $term);
        }

        // 6. Unir ambas consultas en la BD y paginar directamente en MySQL
        $productosPaginados = $localesQuery
            ->unionAll($deltronQuery)
            ->paginate($this->perPage);

        $categoriaSeleccionada = $this->categoria_id 
            ? $categorias->firstWhere('id', $this->categoria_id) 
            : null;

        return view('livewire.catalogo', [
            'categorias'            => $categorias,
            'productos'             => $productosPaginados,
            'categoriaSeleccionada' => $categoriaSeleccionada,
        ]);
    }
}