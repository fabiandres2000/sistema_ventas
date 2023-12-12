@extends("maestra")
@section("titulo", "Detalle de venta ")
@section("contenido")
<br>
    <div class="row">
        <div class="col-12">
            <h1>Detalle de venta #{{$venta->id}}</h1>
            <h1>Cliente: <small>{{$venta->cliente->nombre}}</small></h1>
            @include("notificacion")
            <a class="btn btn-info" href="{{route("ventas.index")}}">
                <i class="fa fa-arrow-left"></i>&nbsp;Volver
            </a>
            <a class="btn btn-success" href="{{route("ventas.ticket", ["id" => $venta->id])}}">
                <i class="fa fa-print"></i>&nbsp;Ticket
            </a>
            <hr>
            <h2>Productos</h2>
            <table class="table table-bordered">
                <thead>
                <tr style="background-color: aquamarine">
                    <th>Descripción</th>
                    <th>Código de barras</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($venta->productos as $producto)
                    <tr>
                        <td>{{$producto->descripcion}}</td>
                        <td>{{$producto->codigo_barras}}</td>
                        <td>${{number_format($producto->precio, 2)}}</td>
                        <td>{{$producto->cantidad}}</td>
                        <td>${{round($producto->cantidad * $producto->precio)}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td style="background-color: aquamarine"><strong>Total</strong></td>
                    <td style="background-color: aquamarine">${{round($total)}}</td>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection
