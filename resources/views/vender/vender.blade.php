@extends("maestra")
@section("titulo", "Realizar venta")
@section("contenido")
<br>
    <div class="row">
        <div class="col-12">
            <h1>Nueva venta <i class="fa fa-cart-plus"></i></h1>
            @include("notificacion")
            <div class="row">
                <div class="col-12 col-md-6">
                    <form action="{{route("terminarOCancelarVenta")}}" method="post">
                        @csrf
                        @if(session("productos") !== null)
                            <div class="form-group">
                                <button name="accion" value="terminar" type="submit" class="btn btn-success">Terminar
                                    venta
                                </button>
                                <button name="accion" value="cancelar" type="submit" class="btn btn-danger">Cancelar
                                    venta
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form action="{{route("agregarProductoVenta")}}" method="post">
                        @csrf
                        <div class="">
                            <label for="codigo"><h1>Código de barras</h1></label>
                            <input id="codigo" autocomplete="off" required autofocus name="codigo" type="text"
                                class="form-control"
                                placeholder="Código de barras">
                        </div>
                    </form>
                </div>
                <div class="col-md-2" style="display: flex;justify-content: start;align-items: flex-end;">
                    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-success">Buscar Manualmente</button>
                </div>
            </div>
            
            <hr>
            @if(session("productos") !== null)
                <h2>Total: ${{number_format($total, 2)}}</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Código de barras</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Quitar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(session("productos") as $producto)
                            <tr>
                                <td>{{$producto->codigo_barras}}</td>
                                <td>{{$producto->descripcion}}</td>
                                <td>${{number_format($producto->precio_venta, 2)}}</td>
                                <td>{{$producto->cantidad}}</td>
                                <td>
                                    <form action="{{route("quitarProductoDeVenta")}}" method="post">
                                        @method("delete")
                                        @csrf
                                        <input type="hidden" name="indice" value="{{$loop->index}}">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h2>Aquí aparecerán los productos de la venta
                    <br>
                    Escanea el código de barras o escribe y presiona Enter</h2>
            @endif
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Selecciona una categoria</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4" style="margin-bottom: 20px">
                        <input required type="radio" id="control_01" name="categoria" value="Aseo" >
                        <label onclick="elegirCategoria('Aseo')" class="lradio" for="control_01">
                            <img src="/img/aseo.png" style="width: 50px" alt="">
                            <p>Aseo</p>
                        </label>
                    </div>
                    <div class="col-lg-4" style="margin-bottom: 20px">
                        <input required type="radio" id="control_02" name="categoria" value="Alimentos">
                        <label class="lradio" for="control_02">
                            <img src="/img/alimentos.png" style="width: 50px" alt="">
                            <p>Alimentos</p>
                        </label>
                    </div>
                    <div class="col-lg-4" style="margin-bottom: 20px">
                        <input required type="radio" id="control_03" name="categoria" value="Bebidas">
                        <label class="lradio" for="control_03">
                            <img src="/img/bebidas.png" style="width: 50px" alt="">
                            <p>Bebidas</p>
                        </label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4" style="margin-bottom: 20px">
                        <input required type="radio" id="control_05" name="categoria" value="Carnes">
                        <label class="lradio" for="control_05">
                            <img src="/img/carne.png" style="width: 50px" alt="">
                            <p>Carnes</p>
                        </label>
                    </div>
                    <div class="col-lg-4" style="margin-bottom: 20px">
                        <input required type="radio" id="control_07" name="categoria" value="Farmacia">
                        <label class="lradio" for="control_07">
                            <img src="/img/farmacia.png" style="width: 50px" alt="">
                            <p>Farmacia</p>
                        </label>
                    </div>
                    <div class="col-lg-4" style="margin-bottom: 20px">
                        <input required type="radio" id="control_06" name="categoria" value="Otros">
                        <label class="lradio" for="control_06">
                            <p>Otros</p>
                        </label>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>

    <script>
        function elegirCategoria(valor){
            $('#exampleModal').modal("hide")
        }
    </script>
@endsection
