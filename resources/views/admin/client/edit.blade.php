@extends('adminlte::page')

@section('title', 'Editar cliente')

@section('content_header')
<h1> Edición de cliente
</h1>
@stop

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
            <li class="breadcrumb-item"><a href="{{route('clients.index')}}">Clientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edición de cliente</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Edición de cliente</h4>
                </div>

                {!! Form::model($client,['route'=>['clients.update',$client], 'method'=>'PUT','files' => true]) !!}


                <div class="form-group">
                    <label for="name">Nombres</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$client->names}}"
                        aria-describedby="helpId" required>
                </div>

                <div class="form-group">
                    <label for="cedula">CEDULA</label>
                    <input type="number" class="form-control" name="cedula" id="cedula" value="{{$client->cedula}}"
                        aria-describedby="helpId" required>
                </div>

                <div class="form-group">
                    <label for="ruc">RUC</label>
                    <input type="number" class="form-control" name="ruc" id="ruc" value="{{$client->ruc}}"
                        aria-describedby="helpId">
                    <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>
                </div>

                <div class="form-group">
                    <label for="address">Dirección</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{$client->address}}"
                        aria-describedby="helpId">
                    <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>
                </div>

                <div class="form-group">
                    <label for="phone">Teléfono \ Celular</label>
                    <input type="number" class="form-control" name="phone" id="phone" value="{{$client->phone}}"
                        aria-describedby="helpId">
                    <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$client->email}}"
                        aria-describedby="helpId">
                    <small id="helpId" class="form-text text-muted">Este campo es opcional.</small>
                </div>


                <button type="submit" class="btn btn-primary mr-2">Editar</button>
                <a href="{{route('clients.index')}}" class="btn btn-light">
                    Cancelar
                </a>
                {!! Form::close() !!}
            </div>
            {{--  <div class="card-footer text-muted">
                    {{$clients->render()}}
        </div> --}}
    </div>
</div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{!! Html::script('melody/js/dropify.js') !!}
@stop