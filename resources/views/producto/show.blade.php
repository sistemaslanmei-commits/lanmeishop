@extends('layouts.app')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="box-shadow: 0px 4px 4px 4px rgba(0, 0, 0, 0.25);">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('productos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group pb-3">
                                    <strong>Nombre:</strong>
                                    {{ $producto->nombre }}
                                </div>
                                <div class="form-group pb-3">
                                    <strong>Precio:</strong>
                                    {{ $producto->precio }}
                                </div>
                                <div class="form-group pb-3">
                                    <strong>Stock:</strong>
                                    {{ $producto->stock }}
                                </div>
                                <div class="form-group pb-3">
                                    <strong>Categoria:</strong>
                                    {{ $producto->categoria->nombreCategoria }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group text-center">
                                    <strong>Imagen:</strong> <br>
                                    <img src="{{ asset('img/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="img-thumbnail" style="max-height: 250px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
