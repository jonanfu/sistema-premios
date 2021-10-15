@extends('adminlte::page')

@section('title', 'Registrar categoria')

@section('content_header')
<h1> Registro de categorías
</h1>
@stop

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
            <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Categorías</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registro de categorías</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Registro de categorías</h4>
                </div>
                {!! Form::open(['route'=>'categories.store', 'method'=>'POST']) !!}
                @include('admin.category._form')
                <button type="submit" class="btn btn-primary mr-2">Registrar</button>
                <a href="{{route('categories.index')}}" class="btn btn-light">
                    Cancelar
                </a>
                {!! Form::close() !!}
            </div>
            {{--  <div class="card-footer text-muted">
                    {{$categories->render()}}
        </div> --}}
    </div>
</div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{!! Html::script('melody/js/data-table.js') !!}

@stop