@extends('layouts.tienda')

@section('content')
<section class="ls ms c-gutter-60 s-pt-50 s-pb-50 s-pt-xl-100 s-pb-xl-50" id="plans">
    <h6 class="d-none">Plans</h6>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-12 text-center col-md-10 offset-md-1 col-lg-8 offset-lg-2">

                <div class="fw-divider-space " style="margin-top: 25px;"></div>

                <h2 class="special-heading text-center big">
                    <span class="d-inline-block bold text-uppercase">
                        Consulta tus puntos </span>
                </h2>

                <div class="fw-divider-space " style="margin-top: 18px;">
                    <form action="{{route('consulta_puntos')}}" class="input-group mb-3" method="POST">
                        <input class="form-control" type="text" placeholder="Ingrese número de cedula">
                        <button type="submit" class="btn  btn-maincolor wide_button p-20">Consultar
                            puntos</button>
                        @csrf
                    </form>
                </div>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach($products as $product)
        <div class="col-4">
            <div class="pricing-plan box-shadow  color_style1">
                <div class="plan-name">
                    <h3>
                        {{$product->name}} </h3>
                </div>
                <div class="pricing-plan-inner">
                    <div class="plan-image">
                        <noscript><img src="{{asset('image/'.$product->image)}}"
                                alt="{{$product->name}}"></noscript><img class="lazyload"
                            src="{{asset('image/'.$product->image)}}" data-src="{{asset('image/'.$product->image)}}"
                            alt="BRONZE">
                    </div>
                    <div class="price-wrap color-darkgrey">
                        <span class="plan-sign">Puntos</span>
                        <span class="plan-price">{{$product->sell_points}}</span>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>
{{ $products -> links() }}

<script>

</script>
@endsection