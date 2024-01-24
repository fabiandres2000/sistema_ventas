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
            <div style="display: none" id="notificacion_alert" class="">
               <span id="mensaje_notificacion"></span>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form id="tuFormulario" onsubmit="return verificarUnidad();" method="post">
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
            <div class="row" style="padding: 20px">
                <div class="col-lg-9" style="padding: 20px; border: 2px solid #80808054;">
                    <h2 style="background-color: aqua; padding: 5px; width: fit-content;">Total: <span id="total_pagar" ></span></h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr style="background-color: #75caeb;">
                                    <th>Código de barras</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Quitar</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyTablaProductos">
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-3" style="padding-top: 60px; text-align: center">
                        <button style="font-size: 20px; height: 100px; width: 70%" data-toggle="modal" data-target="#modalConfirmarCompra" class="btn btn-success">
                            Terminar <br> venta
                        </button>   
                        <br><br>                    
                    <form id="formCancelarVenta" method="post">
                        @csrf
                            <input type="hidden" name="accion" value="cancelar" >
                            <button onclick="cancelarVenta()" style="font-size: 20px; height: 100px; width: 70%" type="button" class="btn btn-danger">
                                Cancelar <br> venta
                            </button>
                    </form>
                </div>
            </div>
            <br><br>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <form id="agregarManualForm" method="post">
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
                            <button onclick="agregarProductoVentaManual()" style="width: 100% !important" type="button" class="btn_modal btn btn-success">Agregar Producto</button>
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
                <form id="terminarCancelarVenta"  method="post">
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
                                <input id="total_pagar_tv" autocomplete="off" required name="total_pagar" style="font-size: 20px" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label style="font-size: 20px" for="">Total Cambio</label>
                                <input autocomplete="off" required name="total_vueltos" id="vueltos" style="font-size: 20px" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label style="font-size: 20px" for="">Total Dinero</label>
                                <input autocomplete="off" id="total_dinero" required name="total_dinero" oninput="calcularCambio(this)" style="font-size: 20px" class="form-control" type="text">
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
                        <input type="hidden" name="accion" value="terminar" >
                        <hr>
                        <div class="col-lg-12">
                            <div class="text-right">
                                <button onclick="terminarVenta()" type="button" class="btn btn-success">Terminar venta</button>
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
            <form id="agregarProductoPeso" method="post">
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
                    <button type="button" onclick="agregarProductoPeso()" class="btn_modal btn btn-success">Agregar Producto</button>
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

                   // Destruir la instancia DataTable y limpiar selecciones al cerrar el modal
                    $('#exampleModal2').on('hidden.bs.modal', function () {
                        $('#tabla_productos_vender').DataTable().destroy();
                        $('#tabla_productos_vender tbody tr').removeClass('selected');
                    });

                    setTimeout(() => {
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
                            agregarProductoVenta();
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

        function agregarProductoVenta(){
            $.ajax({
                url: '/productoDeVenta',
                type: 'POST',
                data: $('#tuFormulario').serialize(), 
                success: function(response) {
                    $("#codigo").val("").focus();
                    if(response.status != "error"){
                        document.getElementById("notificacion_alert").style.display = "none";
                        mapearTablaProductos();
                    }else{
                        mostrarNotificacion(response.message, response.status);
                    }
                }
            });
        }

        function agregarProductoVentaManual(){
            var cantidad = document.getElementById("cantidad_manual").value;
            if(cantidad == ""){
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Ingrese la cantidad o el precio que desea vender",
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                $.ajax({
                    url: '/productoDeVenta',
                    type: 'POST',
                    data: $('#agregarManualForm').serialize(), 
                    success: function(response) {
                        $("#codigo").val("").focus();
                        if(response.status != "error"){
                            location.reload();
                        }else{
                            $('#exampleModal2').modal("hide");
                            mostrarNotificacion(response.message, response.status);
                        }
                    }
                });
            }
        }

        function agregarProductoPeso(){
            var cantidad = document.getElementById("cantidad_manual_peso").value;
            if(cantidad == ""){
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Ingrese la cantidad o el precio que desea vender",
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                $.ajax({
                    url: '/productoDeVenta',
                    type: 'POST',
                    data: $('#agregarProductoPeso').serialize(), 
                    success: function(response) {
                        $("#codigo").val("").focus();
                        if(response.status != "error"){
                            location.reload();
                        }else{
                            $('#modalParaPesar').modal("hide");
                            mostrarNotificacion(response.message, response.status);
                        }
                    }
                });
            }
        }

        function mostrarNotificacion(mensaje, clase){
            var div = document.getElementById("notificacion_alert");
            div.style.display = "block";
            
            var clase_div = "";
            if(clase == "error"){
                var clase_div = "alert-danger";
            }else{
                var clase_div = "alert-"+clase;
            }
           
            div.classList = ["alert"];
            div.classList.add(clase_div);

            var span = document.getElementById("mensaje_notificacion");
            span.innerHTML = mensaje;
        }

        var total = 0;
        var productos = [];

        $(document).ready(function() {
            mapearTablaProductos();

            $('form input').keypress(function(event) {
                if (event.which === 13) {
                    var formId = $(this).closest('form').attr('id');
                    if(formId == "terminarCancelarVenta"){
                        terminarVenta();
                    }
                }
            });
        });

        function mapearTablaProductos(){
            $.ajax({
                url: '/productos-carrito',
                type: 'GET',
                success: function(response) {
                   productos = response.productosCarrito;
                   total = response.total;

                    var tbody = document.getElementById('tbodyTablaProductos');
                    tbody.innerHTML = '';

                    document.getElementById("total_pagar").innerHTML = total.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });;
                    document.getElementById("total_pagar_tv").value = total;

                    productos.forEach(function(producto, index) {
                        var row = '<tr>' +
                            '<td>' + producto.codigo_barras + '</td>' +
                            '<td>' + producto.descripcion + '</td>' +
                            '<td>$' + Number(producto.precio_venta).toFixed(2) + '</td>' +
                            '<td style="text-align: center !important;">';

                        if (producto.unidad_medida == "Unidades") {
                            row += '<form style="display: flex; align-items: center; justify-content: space-around;" id="form_editar_'+index+'" method="post">' +
                                '@method("post")' +
                                '@csrf' +
                                '<input min="1" autocomplete="off" style="width: 70px; font-size: 18px" class="form-control" name="cantidad" type="number" value="' + producto.cantidad + '">' +
                                '<strong> ' + (producto.unidad_medida == "Kilos" ? "Kg" : (producto.unidad_medida == "Libras" ? "Lb" : "Und")) + '</strong>' +
                                '<input type="hidden" name="indice" value="' + index + '">' +
                                '<input type="hidden" name="codigo" value="' + producto.codigo_barras + '">' +
                                '<button type="button" onclick="actualizarProductoVenta('+index+')" style="margin-left: 20px" class="boton_tabla btn btn-warning"><i class="fas fa-sync-alt"></i></button>' +
                                '</form>';
                        } else {
                            row += '<input style="width: 100px; font-size: 18px" class="form-control" disabled type="text" value="' + producto.cantidad + ' ' + (producto.unidad_medida == "Kilos" ? "Kg" : (producto.unidad_medida == "Libras" ? "Lb" : "Und")) + '">';
                        }

                        row += '</td>' +
                            '<td>$' + Number(producto.precio_total).toFixed(2) + '</td>' +
                            '<td style="text-align: center">' +
                            '<form action="{{ route("quitarProductoDeVenta") }}" method="post">' +
                            '@method("delete")' +
                            '@csrf' +
                            '<input type="hidden" name="indice" value="' + index + '">' +
                            '<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>' +
                            '</form>' +
                            '</td>' +
                            '</tr>';

                        tbody.innerHTML += row;
                    });
                }
            });
        }

        function actualizarProductoVenta(index){
            $.ajax({
                url: '/actualizarProductoDeVenta',
                type: 'POST',
                data: $('#form_editar_'+index).serialize(), 
                success: function(response) {
                    $("#codigo").val("").focus();
                    if(response.status != "error"){
                        mostrarNotificacion(response.message, response.status);
                        mapearTablaProductos();
                    }else{
                        mostrarNotificacion(response.message, response.status);
                        mapearTablaProductos();
                    }
                }
            });
        }

        function calcularCambio(element){
            var valor = (-1) * (total - element.value).toFixed(3)
            document.getElementById("vueltos").value = valor;
            if(valor < 0){
                document.getElementById("fiado").value = (-1) * valor;
            }else{
                document.getElementById("fiado").value = 0;
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

        function terminarVenta(){
            var value = document.getElementById("total_dinero").value;
            if(value == ""){
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Ingrese el valor a pagar",
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                if(productos.length > 0){
                    $.ajax({
                        url: '/terminarOCancelarVenta',
                        type: 'POST',
                        data: $('#terminarCancelarVenta').serialize(), 
                        success: function(response) {
                            $("#codigo").val("").focus();

                            $('#modalConfirmarCompra').modal("hide");

                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Venta realizada correctamente",
                                showConfirmButton: false,
                                timer: 2000
                            });
                        
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        }
                    });
                }
            }
           
        }

        function cancelarVenta(){
            if(productos.length > 0){
                Swal.fire({
                    title: "¿Desea cancelar la venta?",
                    text: "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si",
                    cancelButtonText: "No"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/terminarOCancelarVenta',
                            type: 'POST',
                            data: $('#formCancelarVenta').serialize(), 
                            success: function(response) {
                                $("#codigo").val("").focus();
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            
                                setTimeout(() => {
                                    location.reload();
                                }, 2000);
                            }
                        });
                    }
                });
                
            }
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
