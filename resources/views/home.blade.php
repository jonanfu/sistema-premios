@extends('adminlte::page')

@section('title', 'Panel administrador')

@section('content_header')
<h1>Panel administrador</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fas fa-envelope"></i>
                    Productos más vendidos
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th>Nombre</th>
                                <th>Código</th>
                                <th>Stock</th>
                                <th>Cantidad vendida</th>
                                <th>Ver detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productosvendidos as $productosvendido)
                            <tr>
                                <td>$productosvendido->id</td>
                                <td>$productosvendido->name</td>
                                <td>$productosvendido->code</td>
                                <td><strong>$productosvendido->stock</strong> Unidades</td>
                                <td><strong>$productosvendido->quantity</strong> Unidades</td>
                                <td>
                                    <a class="btn btn-primary" href="route('products.show', $productosvendido->id)">
                                        <i class="far fa-eye"></i>
                                        Ver detalles
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{!! Html::script('melody/js/data-table.js') !!}
{!! Html::script('melody/js/chart.js') !!}
@stop