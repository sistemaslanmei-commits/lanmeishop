<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Imports\ProductosImport;
use App\Exports\ProductosExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::paginate();
        $categorias = Categoria::pluck('nombreCategoria', 'id'); // Obtener lista de categorías
        return view('producto.index', compact('productos', 'categorias'))
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::pluck('nombreCategoria', 'id'); // Obtener lista de categorías
        $producto = new Producto();
        return view('producto.create', compact('producto', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validación de campos
            $request->validate([
                'nombre' => 'required',
                'precio' => 'required',
                'stock' => 'required',
                'categoria_id' => 'required',
                'enlace'=>'required',
                'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
            ]);
    
            // Crear el producto
            $producto = Producto::create([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'stock' => $request->stock,
                'categoria_id' => $request->categoria_id,
                'enlace'=> $request->enlace,
                'enlaceVea'=> $request->enlaceVea,
            ]);
    
            // Manejo de la imagen si se proporciona
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = $producto->id . '.' . $imagen->getClientOriginalExtension();
                $rutaDestino = public_path('img/');
                $imagen->move($rutaDestino, $nombreImagen);
    
                $producto->imagen = $nombreImagen;
                $producto->save();
            }
    
            return redirect()->route('productos.index')
                ->with('success', 'Producto creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear el producto: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::pluck('nombreCategoria', 'id'); // Obtener lista de categorías

        return view('producto.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        try {
            // Validación de campos
            //dd($request->all());
            $request->validate([
                'nombre' => 'required',
                'precio' => 'required',
                'stock' => 'required|integer',
                'categoria_id' => 'required',
                'enlace'=>'required',
                'imagen' => 'image|mimes:jpeg,png,jpg,webp,gif|max:2048', // Validación de la imagen
            ]);
    
            // Actualización de campos
            $producto->update([
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'stock' => $request->stock,
                'categoria_id' => $request->categoria_id,
                'enlace'=>$request->enlace,
                'enlaceVea'=>$request->enlaceVea,
            ]);
    
            // Manejo de la imagen si se proporciona
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = $producto->id . '.' . $imagen->getClientOriginalExtension();
                $rutaDestino = public_path('img/');
                
                // Eliminar la imagen anterior si existe
                if ($producto->imagen) {File::delete($rutaDestino . $producto->imagen);}
                
                $imagen->move($rutaDestino, $nombreImagen);

                $producto->imagen = $nombreImagen;
                $producto->save();
            }
    
            return redirect()->route('productos.index')
                ->with('success', 'Producto updated successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al actualizar el producto: ' . $e->getMessage()]);
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $producto = Producto::find($id)->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto deleted successfully');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        Excel::import(new ProductosImport, $request->file('file'));

        return redirect()->route('productos.index')
            ->with('success', 'Datos importados exitosamente');
    }
    public function export()
    {
        $productos = Producto::all();
        return Excel::download(new ProductosExport($productos), 'productos.xlsx');
    }
}
