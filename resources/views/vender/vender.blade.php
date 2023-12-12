@extends("maestra")
@section("titulo", "Realizar venta")
@section("contenido")
<br>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-12 text-right" style="display: flex; justify-content: end">
                    @if(session("productos") !== null)
                        <button style="font-size: 23px" data-toggle="modal" data-target="#modalConfirmarCompra" class="btn btn-success">
                            Terminar venta
                        </button>                       
                    @endif
                    <form style="margin-left: 20px" action="{{route("terminarOCancelarVenta")}}" method="post">
                        @csrf
                        @if(session("productos") !== null)
                            <div class="text-right">
                                <button style="font-size: 23px" name="accion" value="cancelar" type="submit" class="btn btn-danger">Cancelar
                                    venta
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            @include("notificacion")
            <div class="row">
                <div class="col-lg-6">
                    <form action="{{route("agregarProductoVenta")}}" method="post">
                        @csrf
                        <div class="">
                            <label for="codigo"><h1>Código de barras</h1></label>
                            <input type="hidden" name="cantidad" value="1" id="cantidad">
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
                <div class="row">
                    <div class="col-lg-8">
                        <h2 style="background-color: aqua; padding: 5px; width: fit-content;">Total: ${{number_format($total, 2)}}</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Código de barras</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Quitar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(session("productos") as $producto)
                                    <tr>
                                        <td>{{$producto->codigo_barras}}</td>
                                        <td>{{$producto->descripcion}}</td>
                                        <td>${{number_format($producto->precio_venta, 2)}}</td>
                                        <td>
                                          <strong>{{$producto->cantidad}}</strong> {{ $producto->unidad_medida== "Kilos" ? "Kg" : ($producto->unidad_medida == "Libras" ? "Lb" : "Und") }}
                                        </td>
                                        <td>${{number_format($producto->precio_total, 2)}}</td>
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
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3" style="display: flex; flex-wrap: wrap;">
                        @php
                            $elementos = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0, '<i class="fas fa-backspace"></i>'];
                        @endphp
                        @for ($i = 0; $i < count($elementos); $i++)
                            <div style="cursor: pointer; border-radius: 7px; display: flex; justify-content: center; align-items: center;width: 60px; height: 60px; background-color: #44bedc; margin: 10px">
                                <p style="margin:0px; font-size: 28px; font-weight: bold">{!! $elementos[$i] !!}</p>   
                            </div>
                        @endfor
                        <div>
                            <div style="cursor: pointer; border-radius: 7px; display: flex; justify-content: center; align-items: center;width: 60px; height: 60px; background-color: #23a127; margin: 10px; color: white">
                                <p style="margin:0px; font-size: 28px; font-weight: bold"><i class="fas fa-check"></i></p>   
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h2>Aquí aparecerán los productos de la venta
                    <br>
                    Escanea el código de barras o escribe y presiona Enter</h2>
            @endif
            <br><br>
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
                        <label onclick="elegirCategoria('Alimentos')" class="lradio" for="control_02">
                            <img src="/img/alimentos.png" style="width: 50px" alt="">
                            <p>Alimentos</p>
                        </label>
                    </div>
                    <div class="col-lg-4" style="margin-bottom: 20px">
                        <input required type="radio" id="control_03" name="categoria" value="Bebidas">
                        <label onclick="elegirCategoria('Bebidas')" class="lradio" for="control_03">
                            <img src="/img/bebidas.png" style="width: 50px" alt="">
                            <p>Bebidas</p>
                        </label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-4" style="margin-bottom: 20px">
                        <input required type="radio" id="control_05" name="categoria" value="Carnes">
                        <label onclick="elegirCategoria('Carnes')" class="lradio" for="control_05">
                            <img src="/img/carne.png" style="width: 50px" alt="">
                            <p>Carnes</p>
                        </label>
                    </div>
                    <div class="col-lg-4" style="margin-bottom: 20px">
                        <input required type="radio" id="control_07" name="categoria" value="Farmacia">
                        <label onclick="elegirCategoria('Farmacia')" class="lradio" for="control_07">
                            <img src="/img/farmacia.png" style="width: 50px" alt="">
                            <p>Farmacia</p>
                        </label>
                    </div>
                    <div class="col-lg-4" style="margin-bottom: 20px">
                        <input required type="radio" id="control_06" name="categoria" value="Otros">
                        <label onclick="elegirCategoria('Otros')" class="lradio" for="control_06">
                            <p>Otros</p>
                        </label>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Selecciona un producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route("agregarProductoVenta")}}" method="post">
                @csrf
                <div class="modal-body">
                
                    <div id="lista_productos" class="row">

                    </div>
                    <br>
                    <hr>
                    <h2 style="background-color: aqua; padding: 5px; width: fit-content;">Precio venta = <strong id="etiqueta_precio"></strong></h2>
                    <input id="codigo_barras" autocomplete="off" required name="codigo" type="hidden"class="form-control">
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <label style="font-size: 25px; font-weight: bold" for="precio">Precio a vender</label>
                            <input style="font-size: 25px; font-weight: bold" required oninput="calcularKilos(this)" id="precio" name="precio" type="text" class="form-control" placeholder="peso en libras o unidades">
                        </div>
                        <div class="col-lg-6">
                            <label style="font-size: 25px; font-weight: bold" for="cantidad_manual">Peso en kilos o unidades</label>
                            <input style="font-size: 25px; font-weight: bold" required oninput="calcularPrecio(this)" id="cantidad_manual" name="cantidad" type="text" class="form-control" placeholder="peso en libras o unidades">
                        </div>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <button onclick="volverSeleccionarCategoria()" class="btn btn-danger">Volver</button>
                    <button type="submit" class="btn btn-success">Agregar Producto</button>
                </div>
            </form>
          </div>
        </div>
    </div>

    <div class="modal" id="modalConfirmarCompra" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title">Confirmar Compra</h2>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{route("terminarOCancelarVenta")}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select style="font-size: 20px;" name="id_cliente" class="form-control" id="cliente">
                                    @foreach($clientes as $cliente)
                                        <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style="font-size: 20px" for="">Total a pagar</label>
                                <input  required name="total_pagar" style="font-size: 20px" class="form-control" type="text" value="{{round($total, 2)}}">
                            </div>
                            <div class="form-group">
                                <label style="font-size: 20px" for="">Total Cambio</label>
                                <input required name="total_vueltos" id="vueltos" style="font-size: 20px" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style="font-size: 20px" for="">Total Dinero</label>
                                <input required name="total_dinero" oninput="calcularCambio(this, {{$total}})" style="font-size: 20px" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label style="font-size: 20px" for="">Total Fiado</label>
                                <input id="fiado" required name="total_fiado" style="font-size: 20px" class="form-control" type="currency">
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12">
                            <div class="text-right">
                                @if(session("productos") !== null)
                                    <button  name="accion" value="terminar" type="submit" class="btn btn-success">Terminar venta</button>
                                @endif
                                <a style="color: white" class="btn btn-danger" data-dismiss="modal">Cerrar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>

    <script>
        function elegirCategoria(valor){
            $.ajax({
                url: '/productos-categoria?categoria='+valor,
                type: 'GET',
                success: function(response) {
                    $('#exampleModal').modal("hide")
                    $('#exampleModal2').modal("show")

                    var div_lista = document.getElementById("lista_productos");
                    var div = "";
                    id = 123;
                    response.forEach(element => {
                        div += '<div class="col-lg-2" style="margin-bottom: 20px">'+
                                    '<input required type="radio" id="control_'+id+'" name="producto_manual" value="'+element.codigo_barras+'">'+
                                    '<label onclick="seleccionarProducto(\'' + element.codigo_barras + '\', '+element.precio_venta+')" class="lradio" for="control_'+id+'" style="padding-top: 0px !important">'+
                                        '<img src="/imagenes_productos/'+element.imagen+'" style="width: 50px" alt="">'+
                                        '<p style="font-size: 13px">'+element.descripcion+'</p>'+
                                    '</label>'+
                                '</div>';

                            id++;
                    });

                    div_lista.innerHTML = "";
                    div_lista.innerHTML = div;
                }
            });
        }

        var precio_seleccionado = 0;
        function seleccionarProducto(item, precio){
            document.getElementById("codigo_barras").value = item;
            precio_seleccionado = precio;

            document.getElementById("etiqueta_precio").innerHTML = precio_seleccionado.toLocaleString("en", {
                style: "currency",
                currency: "COP"
            });
        }

        function calcularKilos(element){
            var numero = (element.value / precio_seleccionado);
            let numeroRedondeado = numero % 1 !== 0 ? parseFloat(numero.toFixed(3)) : numero;
            document.getElementById("cantidad_manual").value = numeroRedondeado;
        }

        function calcularPrecio(element){
            document.getElementById("precio").value = (element.value * precio_seleccionado).toFixed(3);
        }

        function calcularCambio(element, total){
            var valor = (-1) * (total - element.value).toFixed(3)
            document.getElementById("vueltos").value = valor;
            if(valor < 0){
                document.getElementById("fiado").value = (-1) * valor;
            }else{
                document.getElementById("fiado").value = 0;
            }
        }

        function volverSeleccionarCategoria(){
            $('#exampleModal2').modal("hide")
            $('#exampleModal').modal("show")
        }
    </script>
@endsection
