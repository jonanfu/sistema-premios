@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1> {{$client->name}}
</h1>
@stop

@section('content')
<div class="page-header">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
            <li class="breadcrumb-item"><a href="{{route('clients.index')}}">Clientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$client->name}}</li>
        </ol>
    </nav>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="border-bottom text-center pb-4">
                            <h3>{{$client->names}}</h3>
                            <div class="d-flex justify-content-between">
                            </div>
                        </div>
                        <div class="border-bottom py-4">
                            <div class="list-group">
                                <a class="list-group-item list-group-item-action active" id="list-home-list"
                                    data-toggle="list" href="#list-home" role="tab" aria-controls="home">
                                    Sobre cliente
                                </a>
                                <a class="list-group-item list-group-item-action" id="list-profile-list"
                                    data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">
                                    Historial de compras
                                </a>
                                <a class="list-group-item list-group-item-action" id="list-referred-list"
                                    data-toggle="list" href="#list-referred" role="tab" aria-controls="referred">
                                    Lista de referidos
                                </a>
                                {{--  <button type="button" class="list-group-item list-group-item-action">Registrar
                                        producto</button>  --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 pl-lg-5">




                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="list-home" user="tabpanel"
                                aria-labelledby="list-home-list">

                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4>Información de cliente</h4>
                                    </div>
                                </div>
                                <div class="profile-feed">
                                    <div class="d-flex align-items-start profile-feed-item">

                                        <div class="form-group col-md-6">
                                            <strong><i class="fab fa-product-hunt mr-1"></i> Nombre</strong>
                                            <p class="text-muted">
                                                {{$client->names}}
                                            </p>
                                            <hr>
                                            <strong><i class="fas fa-address-card mr-1"></i>Apellidos</strong>
                                            <p class="text-muted">
                                                {{$client->lastname}}
                                            </p>
                                            <hr>
                                            <strong><i class="fas fa-address-card mr-1"></i> Numero de
                                                Cedula</strong>
                                            <p class="text-muted">
                                                {{$client->cedula}}
                                            </p>
                                            <hr>
                                            <strong><i class="fas fa-mobile mr-1"></i>Cantidad de puntos</strong>
                                            <p class="text-muted">
                                                {{$client->points}}
                                            </p>
                                            <hr>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <strong>
                                                <i class="fas fa-mobile mr-1"></i>
                                                Dirección</strong>
                                            <p class="text-muted">
                                                {{$client->address}}
                                            </p>
                                            <hr>
                                            <strong><i class="fas fa-envelope mr-1"></i> Teléfono / Celular</strong>
                                            <p class="text-muted">
                                                {{$client->phone}}
                                            </p>
                                            <hr>
                                            <strong><i class="fas fa-map-marked-alt mr-1"></i> Correo
                                                electrónico</strong>
                                            <p class="text-muted">
                                                {{$client->email}}
                                            </p>
                                            <hr>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane fade" id="list-profile" user="tabpanel"
                                aria-labelledby="list-profile-list">


                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4>Historial de compras</h4>
                                    </div>
                                </div>
                                <div class="profile-feed">
                                    <div class="d-flex align-items-start profile-feed-item">

                                        <div class="table-responsive">
                                            <table id="order-listing" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Fecha</th>
                                                        <th>Total</th>
                                                        <th>Estado</th>
                                                        <th style="width:50px;">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($client->sales as $sale)
                                                    <tr>
                                                        <th scope="row">
                                                            <a href="{{route('sales.show', $sale)}}">{{$sale->id}}</a>
                                                        </th>
                                                        <td>{{$sale->purchase_date}}</td>
                                                        <td>{{$sale->total}}</td>

                                                        @if ($sale->status == 'VALID')
                                                        <td>
                                                            <a class="jsgrid-button btn btn-success"
                                                                href="{{route('change.status.sales', $sale)}}"
                                                                title="Editar">
                                                                Activo <i class="fas fa-check"></i>
                                                            </a>
                                                        </td>
                                                        @else
                                                        <td>
                                                            <a class="jsgrid-button btn btn-danger"
                                                                href="{{route('change.status.sales', $sale)}}"
                                                                title="Editar">
                                                                Cancelado <i class="fas fa-times"></i>
                                                            </a>
                                                        </td>
                                                        @endif
                                                        <td style="width: 50px;">

                                                            <a href="{{route('sales.pdf', $sale)}}"
                                                                class="jsgrid-button jsgrid-edit-button"><i
                                                                    class="far fa-file-pdf"></i></a>

                                                            <a href="{{route('sales.show', $sale)}}"
                                                                class="jsgrid-button jsgrid-edit-button"><i
                                                                    class="far fa-eye"></i></a>


                                                        </td>
                                                        @empty
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2"><strong>Total de puntos: </strong></td>
                                                        <td colspan="3" align="left">
                                                            <strong>{{$total_purchases}}</strong>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="list-referred" user="tabpanel"
                                aria-labelledby="list-referred-list">


                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4>Lista de referidos</h4>
                                    </div>
                                </div>
                                <div class="profile-feed">
                                    <div class="d-flex align-items-start profile-feed-item">

                                        <div class="table-responsive">
                                            <table id="order-listing" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Nombre</th>
                                                        <th>Cedula</th>
                                                        <th>Correo</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($client->referrals as $referred)
                                                    <tr>
                                                        <th scope="row">
                                                            {{$referred->id}}</a>
                                                        </th>
                                                        <td>{{$referred->full_name}}</td>
                                                        <td>{{$referred->cedula}}</td>
                                                        <td>
                                                            {{$referred->email}}
                                                        </td>


                                                    </tr>
                                                    @empty
                                                    <p>No users</p>
                                                    @endforelse
                                                </tbody>

                                            </table>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>



            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="{{route('clients.index')}}" class="btn btn-primary float-right">Regresar</a>
        </div>
    </div>
</div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{!! Html::script('melody/js/profile-demo.js') !!}
{!! Html::script('melody/js/data-table.js') !!}
@stop