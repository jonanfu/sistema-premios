@extends('layouts.tienda')

@section('content')
@foreach($products as $product)
<div class="col">
    <div class="card shadow-sm">
        <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="{{asset('image/'.$product->image)}}">

    <div class="card-body">
        <h5 class="card-title">{{$product->name}}</h5>
        <p class="card-text">{{$product->stock}} Premios disponibles</p>
        <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
            </div>
                <small class="text-muted">Cantidad de puntos: {{$product->sell_points}}</small>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection