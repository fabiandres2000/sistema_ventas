@extends("maestra")
@section("titulo", "Productos")
@section("contenido")
<br>
    <div class="row">
        <div class="col-12">
            <h1>Productos <i class="fa fa-box"></i></h1>
            <a href="{{route("productos.create")}}" class="btn btn-success mb-2">Agregar</a>
            <hr>
            @include("notificacion")
            <div class="table-responsive">
                <table id="tabla_productos" class="table table-bordered">
                    <thead style="background-color: #91baee">
                        <tr>
                            <th>Imagen</th>
                            <th>Código de barras</th>
                            <th>Descripción</th>
                            <th>Precio de compra</th>
                            <th>Precio de venta</th>
                            <th>Utilidad</th>
                            <th>Existencia</th>
                            <th>opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($productos as $producto)
                        <tr>
                            <td style="text-align: center">
                                <img style="height: 70px" src="/imagenes_productos/{{$producto->imagen}}" alt="">
                            </td>
                            <td>{{$producto->codigo_barras}}</td>
                            <td>{{$producto->descripcion}}</td>
                            <td>{{$producto->precio_compra}}</td>
                            <td>{{$producto->precio_venta}}</td>
                            <td>{{$producto->precio_venta - $producto->precio_compra}}</td>
                            <td>{{$producto->existencia}}</td>
                            <td style="text-align: center">
                                <a class="btn btn-warning" href="{{route("productos.edit",[$producto])}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <hr>
                                <form action="{{route("productos.destroy", [$producto])}}" method="post">
                                    @method("delete")
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br><br><br><br>
            </div>
        </div>
    </div>
    <script>
        $('#tabla_productos').DataTable({
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
                }
            });
    </script>
@endsection
