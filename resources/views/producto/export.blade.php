<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoría ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
        <tr>
            <td>{{ $producto->id }}</td>
            <td>{{ $producto->nombre }}</td>
            <td>{{ $producto->precio }}</td>
            <td>{{ $producto->stock }}</td>
            <td>{{ $producto->categoria_id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<hr>

<table>
    <thead>
        <tr>
            <th>ID Categoría</th>
            <th>Nombre Categoría</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $categoria)
        <tr>
            <td>{{ $categoria->id }}</td>
            <td>{{ $categoria->nombreCategoria }}</td>
        </tr>
        @endforeach
    </tbody>
</table>