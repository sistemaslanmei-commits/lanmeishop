<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

//Auth::routes();
Auth::routes(['register' => false]);

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::resource('/admin/productos', App\Http\Controllers\ProductoController::class);
Route::resource('/admin/categorias', App\Http\Controllers\CategoriaController::class);
Route::post('/admin/productos/import', [App\Http\Controllers\ProductoController::class, 'import'])->name('productos.import');
Route::post('/admin/productos/export', [App\Http\Controllers\ProductoController::class, 'export'])->name('productos.export');
//Route::post('/admin/productos/export', [App\Http\Controllers\ProductoController::class, 'export'])->name('producto.export');

Route::resource('/admin/registro', App\Http\Controllers\RegistroController::class);

// libro de reclamaciones
Route::get('/libro-de-reclamaciones', function () {
    return view('libro-de-reclamaciones');
});

Route::post('/reclamaciones', [App\Http\Controllers\ReclamacionesController::class, 'store'])->name('reclamaciones.store');