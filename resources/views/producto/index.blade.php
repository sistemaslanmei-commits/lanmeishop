@extends('layouts.app')

@section('template_title')
    Producto
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Producto') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Imagen</th>
										<th>Nombre</th>
										<th>Precio</th>
                                        <th>Enlace Falabella</th>
                                        <th>Enlace Plaza Vea</th>
										<th>Stock</th>
										<th>Categoria</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td><img src="{{ asset('img/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="50"></td>
											<td>{{ $producto->nombre }}</td>
											<td>{{ $producto->precio }}</td>
                                            
                                            <td style="max-width: 120px;">{{$producto->enlace}}</td>
                                            
                                            <td style="max-width: 120px;">{{$producto->enlaceVea}}</td>
											
                                            <td>{{ $producto->stock }}</td>
                                        
                                            <td>{{              $producto->categoria->nombreCategoria }}</td>

                                            <td>
                                                <form action="{{ route('productos.destroy',$producto->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('productos.show',$producto->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('productos.edit',$producto->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Agrega el formulario de importación con estilos de Bootstrap -->
                            <form action="{{ route('productos.import') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <label for="file">Seleccionar archivo Excel:</label>
                                        <input type="file" class="form-control-file @error('file') is-invalid @enderror" id="file" name="file">
                                        @error('file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">Importar</button>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('productos.export') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Exportars Productos</button>
                            </form>

                        </div>
                    </div>
                </div>
                {!! $productos->links() !!}
            </div>
        </div>
    </div>
@endsection
