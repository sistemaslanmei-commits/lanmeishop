<!-- resources/views/livewire/product-table.blade.php -->

<div>
        <div class="row mb-3">
            <div class="col-md-6">
                <!-- Botón para abrir modal de creación -->
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                    Añadir Producto
                </button>
            </div>
            <div class="col-md-6">
                <!-- Campo de búsqueda y filtro -->
                <input type="text" class="form-control" placeholder="Buscar..." wire:model="search">
            </div>
        </div>
        
        <!-- Tabla de productos -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->nombre }}</td>
                    <td><img src="{{ asset('img/' . $product->imagen) }}" alt="{{ $product->nombre }}" width="50"></td>
                    <td>{{ $product->precio }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->categoria->nombreCategoria }}</td>
                    <td>
                        <!-- Botones de acciones -->
                        <button type="button" class="btn btn-primary" wire:click="edit({{ $product->id }})">Editar</button>

                        <button class="btn btn-sm btn-danger" wire:click="confirmDelete({{ $product->id }})">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
        <!-- Paginación -->
<!-- Modal para mostrar los detalles del producto -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Detalles del Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID:</th>
                            <td id="modal-id"></td>
                        </tr>
                        <tr>
                            <th>Nombre:</th>
                            <td id="modal-nombre"></td>
                        </tr>
                        <tr>
                            <th>Precio:</th>
                            <td id="modal-precio"></td>
                        </tr>
                        <!-- Agrega aquí más filas para los otros campos que deseas mostrar -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <!-- Modal de creación -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Añadir Producto Nuevo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" wire:model="nombre">
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="text" class="form-control" wire:model="imagen" disabled>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" class="form-control" wire:model="precio">
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" wire:model="stock">
                        </div>
                        <div class="form-group">
                            <label for="categoria_id">Categoría</label>
                            <select class="form-control" wire:model="categoria_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nombreCategoria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" wire:click="create">Guardar</button>
                </div>
            </div>
        </div>
    </div>

<!-- resources/views/livewire/product-table.blade.php -->


</div>
