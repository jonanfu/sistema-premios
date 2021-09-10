@extends('adminlte::page')

@section('title', 'Compras')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Registro de compra
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('purchases.index')}}">Compras</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registro de compra</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                {!! Form::open(['route'=>'purchases.store', 'method'=>'POST']) !!}
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Registro de compra</h4>
                    </div>

                    @include('admin.purchase._form')


                </div>
                <div class="card-footer text-muted">
                    <button type="submit" id="guardar" class="btn btn-primary float-right">Registrar</button>
                    <a href="{{route('purchases.index')}}" class="btn btn-light">
                        Cancelar
                    </a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{!! Html::script('melody/js/alerts.js') !!}
{!! Html::script('melody/js/avgrund.js') !!}

{!! Html::script('select/dist/js/bootstrap-select.min.js') !!}
{!! Html::script('js/sweetalert2.all.min.js') !!}
<script>
$(document).ready(function() {
    $("#agregar").click(function() {
        agregar();
    });
});

var cont = 0;
total = 0;
subtotal = [];

$("#guardar").hide();


var product_id = $('#product_id');
product_id.change(function() {
    $.ajax({
        url: "{{route('get_products_by_id')}}",
        method: 'GET',
        data: {
            product_id: product_id.val(),
        },
        success: function(data) {
            $("#code").val(data.code);
        }
    });
});



function agregar() {

    product_id = $("#product_id").val();
    producto = $("#product_id option:selected").text();
    quantity = $("#quantity").val();
    price = $("#price").val();

    if (product_id != "" && quantity != "" && quantity > 0 && price != "") {
        subtotal[cont] = quantity * price;
        total = total + subtotal[cont];
        var fila = '<tr class="selected" id="fila' + cont +
            '"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar(' + cont +
            ');"><i class="fa fa-times"></i></button></td> <td><input type="hidden" name="product_id[]" value="' +
            product_id + '">' + producto + '</td> <td> <input type="hidden" id="price[]" name="price[]" value="' +
            price + '"> <input class="form-control" type="number" id="price[]" value="' + price +
            '" disabled> </td>  <td> <input type="hidden" name="quantity[]" value="' + quantity +
            '"> <input class="form-control" type="number" value="' + quantity +
            '" disabled> </td> <td align="right">s/' + subtotal[cont] + ' </td></tr>';
        cont++;
        limpiar();
        totales();
        evaluar();
        $('#detalles').append(fila);
    } else {
        Swal.fire({
            type: 'error',
            text: 'Rellene todos los campos del detalle de la compras',

        })
    }
}

function limpiar() {
    $("#quantity").val("");
    $("#price").val("");
}

function totales() {
    $("#total_pagar_html").html(total);
    $("#total").html(total.toFixed(2));
    $("#total_pagar").val(total);
}

function evaluar() {
    if (total > 0) {
        $("#guardar").show();
    } else {
        $("#guardar").hide();
    }
}

function eliminar(index) {
    total = total;
    $("#total").html(total);
    $("#fila" + index).remove();
    evaluar();
}
</script>
@stop