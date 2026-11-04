@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Panel de Administración</h1>
    <hr>
    <div>
        productos: <a class="btn btn-primary" href="admin/productos" role="button"> Ver productos</a>
    </div>
    <br>
    <div>
        Categorias: <a class="btn btn-primary" href="admin/categorias" role="button">Ver categorias</a>
    </div>

    <div>
        Registro de ingreso: <a class="btn btn-primary" href="admin/registro" role="button">Ver Registro</a>
    </div>
</div>

@endsection
