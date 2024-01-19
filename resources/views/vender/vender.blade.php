@extends("maestra")
@section("titulo", "Realizar venta")
@section("contenido")
<br>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-12 text-right" style="display: flex; justify-content: end">
                    
                </div>
            </div>
            @include("notificacion")
            <div class="row">
                <div class="col-lg-6">
                    <form id="tuFormulario" action="{{ route('agregarProductoVenta') }}" onsubmit="return verificarUnidad();" method="post">
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
                    <button onclick="elegirCategoria()" class="btn btn-success">Buscar Manualmente</button>
                </div>
            </div>
            
            <hr>
            @if(session("productos") !== null)
                <div class="row">
                    <div class="col-lg-9">
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
                                        <td style="text-align: center !important;">
                                            @if ($producto->unidad_medida == "Unidades")
                                                <form style="display: flex; align-items: center; justify-content: space-around;" action="{{route("actualizarProductoDeVenta")}}" method="post">
                                                    @method("post")
                                                    @csrf
                                                    <input min="1" autocomplete="off" style="width: 70px; font-size: 18px" class="form-control" name="cantidad" type="number" value="{{$producto->cantidad}}">
                                                    <strong> {{ $producto->unidad_medida== "Kilos" ? "Kg" : ($producto->unidad_medida == "Libras" ? "Lb" : "Und") }}</strong>
                                                    <input type="hidden" name="indice" value="{{$loop->index}}">
                                                    <input type="hidden" name="codigo" value="{{$producto->codigo_barras}}">
                                                    <button style="margin-left: 20px" class="boton_tabla btn btn-warning"><i class="fas fa-sync-alt"></i></button>
                                                </form>
                                            @else
                                                <input style="width: 100px; font-size: 18px" class="form-control" disabled type="text" value="{{$producto->cantidad}} {{ $producto->unidad_medida== "Kilos" ? "Kg" : ($producto->unidad_medida == "Libras" ? "Lb" : "Und") }}">
                                            @endif
                                        </td>
                                        <td>${{number_format($producto->precio_total, 2)}}</td>
                                        <td style="text-align: center">
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
                    <div class="col-lg-3" style="padding-top: 60px; text-align: center">
                        @if(session("productos") !== null)
                            <button style="font-size: 20px; height: 100px; width: 70%" data-toggle="modal" data-target="#modalConfirmarCompra" class="btn btn-success">
                                Terminar <br> venta
                            </button>   
                            <br><br>                    
                        @endif
                        <form action="{{route("terminarOCancelarVenta")}}" method="post">
                            @csrf
                            @if(session("productos") !== null)
                                <button style="font-size: 20px; height: 100px; width: 70%" name="accion" value="cancelar" type="submit" class="btn btn-danger">
                                    Cancelar <br> venta
                                </button>
                            @endif
                        </form>
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

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <form action="{{route("agregarProductoVenta")}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <h2 style="background-color: rgba(255, 208, 0, 0.541); padding: 5px; width: 100%;">Producto: <br><strong id="etiqueta_nombre"></strong></h2>
                        </div>
                        <div class="col-lg-3">
                            <h2 style="background-color: rgba(0, 255, 255, 0.377); padding: 5px; width: 100%;">Precio venta: <strong id="etiqueta_precio"></strong></h2>
                        </div>
                        <div class="col-lg-3">
                            <button style="width: 100% !important" type="submit" class="btn_modal btn btn-success">Agregar Producto</button>
                        </div>
                        <div class="col-lg-3">
                            <button style="width: 100% !important" type="button" data-dismiss="modal" class="btn_modal btn btn-danger">Cerrar</button>
                        </div>
                    </div>
                    <input id="codigo_barras" autocomplete="off" required name="codigo" type="hidden"class="form-control">
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <label style="font-size: 25px; font-weight: bold" for="precio">Precio a vender</label>
                            <input autocomplete="off" style="font-size: 25px; font-weight: bold" required oninput="calcularKilos(this)" id="precio" name="precio" type="text" class="form-control" placeholder="precio de venta">
                        </div>
                        <div class="col-lg-6">
                            <label style="font-size: 25px; font-weight: bold" for="cantidad_manual">Peso o Unidades</label>
                            <input autocomplete="off" style="font-size: 25px; font-weight: bold" required oninput="calcularPrecio(this)" id="cantidad_manual" name="cantidad" type="text" class="form-control" placeholder="peso en o unidades">
                        </div>
                    </div>
                    <hr>
                    <table id="tabla_productos_vender" style="width: 100%; font-size: 16px !important">
                        <thead>
                            <tr style="background-color: aqua;">
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Disponible</th>
                            </tr>
                        </thead>
                        <tbody id="lista_productos" >

                        </tbody>
                    </table>
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
                                <input autocomplete="off" required name="total_pagar" style="font-size: 20px" class="form-control" type="text" value="{{round($total, 2)}}">
                            </div>
                            <div class="form-group">
                                <label style="font-size: 20px" for="">Total Cambio</label>
                                <input autocomplete="off" required name="total_vueltos" id="vueltos" style="font-size: 20px" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style="font-size: 20px" for="">Total Dinero</label>
                                <input autocomplete="off" required name="total_dinero" oninput="calcularCambio(this, {{$total}})" style="font-size: 20px" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label style="font-size: 20px" for="">Total Fiado</label>
                                <input autocomplete="off" id="fiado" required name="total_fiado" style="font-size: 20px" class="form-control" type="currency">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style="font-size: 20px" for="">Imprimir factura</label>
                                <select name="imprimir_factura" id="imprimir_factura" class="form-control">
                                    <option value="no">no</option>
                                    <option value="si">si</option>
                                </select>
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


    <div class="modal fade" id="modalParaPesar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <br>
            <form action="{{route("agregarProductoVenta")}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <h2 style="background-color: rgb(243, 221, 122); padding: 5px; width: fit-content;">Producto: <strong id="etiqueta_nombre_peso"></strong></h2>
                        </div>
                        <div class="col-lg-7">
                            <h2 style="background-color: rgb(183, 255, 255); padding: 5px; width: fit-content;">Precio venta: <strong id="etiqueta_precio_peso"></strong></h2>
                        </div>
                    </div>
                    <input id="codigo_barras_peso" autocomplete="off" required name="codigo" type="hidden"class="form-control">
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <label style="font-size: 25px; font-weight: bold" for="cantidad_manual_peso">Peso en libras o kilos</label>
                            <input autocomplete="off" style="font-size: 25px; font-weight: bold" required oninput="calcularPrecioPeso(this)" id="cantidad_manual_peso" name="cantidad" type="text" class="form-control" placeholder="peso en libras o kilos">
                        </div>
                        <div class="col-lg-6">
                            <label style="font-size: 25px; font-weight: bold" for="precio_peso">Precio a vender</label>
                            <input autocomplete="off" style="font-size: 25px; font-weight: bold" id="precio_peso" oninput="calcularKilosPeso(this)" name="precio_peso" type="text" class="form-control" placeholder="$0.00">
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="justify-content: center">
                    <button type="button" id="obtenerPesoBoton" class="btn_modal btn btn-warning">Obtener Peso</button>
                    <button type="submit" class="btn_modal btn btn-success">Agregar Producto</button>
                    <button type="button" data-dismiss="modal" class="btn_modal btn btn-danger">Cerrar</button>
                </div>
            </form>
          </div>
        </div>
    </div>

    <script>
        function elegirCategoria(){
            $.ajax({
                url: '/productos-categoria',
                type: 'GET',
                success: function(response) {
                    $('#exampleModal2').modal("show");
                    var div_lista = document.getElementById("lista_productos");
                    var div = "";
                    id = 123;
                    response.forEach(element => {
                        div += '<tr style="cursor:pointer" onclick="seleccionarProducto(\'' + element.codigo_barras + '\', '+element.precio_venta+', \'' + element.descripcion + '\')" class="producto-row" id="row_'+id+'" style="margin-bottom: 20px">'+
                                    '<td>'+
                                        '<img src="/imagenes_productos/'+element.imagen+'" style="width: 50px" alt="">'+
                                    '</td>'+
                                    '<td>'+
                                        '<p style="font-size: 16px">'+element.descripcion+'</p>'+
                                    '</td>'+
                                    '<td>'+
                                        '<p style="font-size: 16px">'+element.precio_venta+'</p>'+
                                    '</td>'+
                                    '<td>'+
                                        '<p style="font-size: 16px">'+element.existencia+' <strong>'+element.unidad_medida+'</strong></p>'+
                                    '</td>'+
                                '</tr>';
                        id++;
                    });

                    div_lista.innerHTML = "";
                    div_lista.innerHTML = div;

                    setTimeout(() => {
                        if ($.fn.DataTable.isDataTable('#tabla_productos_vender')) {
                            $('#tabla_productos_vender').DataTable().destroy();
                        }

                        var table =  $('#tabla_productos_vender').DataTable({
                            language: {
                                "decimal": "",
                                "emptyTable": "No hay información",
                                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                                "infoEmpty": "Mostrando 0 to 0 of 0 Productos",
                                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                                "infoPostFix": "",
                                "thousands": ",",
                                "lengthMenu": "Mostrar _MENU_ Productos",
                                "loadingRecords": "Cargando...",
                                "processing": "Procesando...",
                                "search": "Buscar:",
                                "zeroRecords": "Sin resultados encontrados",
                                "paginate": {
                                    "first": "Primero",
                                    "last": "Ultimo",
                                    "next": "Siguiente",
                                    "previous": "Anterior"
                                }
                            },
                            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]], // Cantidad de productos por página
                            "pageLength": 5 
                        });

                        $('#tabla_productos_vender tbody').on( 'click', 'tr', function () {
                            if ( $(this).hasClass('selected') ) {
                                $(this).removeClass('selected');
                            }
                            else {
                                table.$('tr.selected').removeClass('selected');
                                $(this).addClass('selected');
                            }
                        });
                    }, 500);
                }
            });
        }

        var precio_seleccionado = 0;
        function seleccionarProducto(item, precio, nombre_producto){
            document.getElementById("codigo_barras").value = item;
            precio_seleccionado = precio;

            document.getElementById("etiqueta_precio").innerHTML = precio_seleccionado.toLocaleString("en", {
                style: "currency",
                currency: "COP"
            });

            document.getElementById("etiqueta_nombre").innerHTML = nombre_producto;
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

        function verificarUnidad(){
            var codigo = document.getElementById('codigo').value;
            if (codigo === '') {
                alert('Por favor ingresa un código de barras válido.');
                return false;
            }else{
                $.ajax({
                    url: '/verificarUnidadProducto?codigo='+codigo,
                    type: 'GET',
                    success: function(response) {
                        if(response.unidad_medida != "Libras" && response.unidad_medida != "Kilos"){
                            document.getElementById('tuFormulario').submit();
                        }else{
                            $('#modalParaPesar').modal("show");

                            precio_seleccionado = response.precio_venta;

                            document.getElementById("etiqueta_precio_peso").innerHTML = response.precio_venta.toLocaleString("en", {
                                style: "currency",
                                currency: "COP"
                            });

                            document.getElementById("codigo_barras_peso").value = response.codigo_barras;
                            document.getElementById("etiqueta_nombre_peso").innerHTML = response.descripcion;
                        }
                    }
                });
                return false;
            }
        }

        function calcularPrecioPeso(element){
            document.getElementById("precio_peso").value = redondearAl100(element.value * precio_seleccionado);
        }

        function calcularKilosPeso(element){
            var numero = (element.value / precio_seleccionado);
            let numeroRedondeado = numero % 1 !== 0 ? parseFloat(numero.toFixed(3)) : numero;
            document.getElementById("cantidad_manual_peso").value = numeroRedondeado;
        }

        function redondearAl100(numero) {
            return Math.round(numero / 100) * 100;
        }

        document.addEventListener('keydown', (event) => {
            var keyValue = event.key;
            if(keyValue == "Shift"){
                $('#modalConfirmarCompra').modal("show")
            }
        }, false);

        function obtenerPeso() {
            $.ajax({
                url: '/leer-peso',
                method: 'GET',
                dataType: 'json',
                success: function (datos) {
                    document.getElementById("cantidad_manual_peso").value = datos;
                    document.getElementById("precio_peso").value = redondearAl100(datos * precio_seleccionado);
                },
                error: function (error) {
                    console.error('Error al obtener el peso', error);
                }
            });
        }

        $('#obtenerPesoBoton').click(obtenerPeso);

    </script>
@endsection
