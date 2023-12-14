@extends("maestra")
@section("titulo", "Editar producto")
@section("contenido")
<br>
    <div class="row">
        <div class="col-12">
            <h1>Editar producto</h1>
            <form method="POST" action="{{route("productos.update", [$producto])}}">
                @method("PUT")
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label class="label">Código de barras</label>
                            <input required value="{{$producto->codigo_barras}}" autocomplete="off" name="codigo_barras"
                                class="form-control"
                                type="text" placeholder="Código de barras">
                        </div>
                        <div class="form-group">
                            <label class="label">Descripción</label>
                            <input required value="{{$producto->descripcion}}" autocomplete="off" name="descripcion"
                                class="form-control"
                                type="text" placeholder="Descripción">
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="label">Precio de compra</label>
                                    <input required value="{{$producto->precio_compra}}" autocomplete="off" name="precio_compra"
                                        class="form-control"
                                        type="decimal(9,2)" placeholder="Precio de compra">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="label">Precio de venta</label>
                                    <input required value="{{$producto->precio_venta}}" autocomplete="off" name="precio_venta"
                                        class="form-control"
                                        type="decimal(9,2)" placeholder="Precio de venta">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="label">Existencia</label>
                                    <input required value="{{$producto->existencia}}" autocomplete="off" name="existencia"
                                        class="form-control"
                                        type="decimal(9,2)" placeholder="Existencia">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="label">Medida</label>
                                    <select name="unidad_medida" id="unidad_medida" class="form-control">
                                        <option {{ $producto->unidad_medida == 'Unidades' ? 'selected' : '' }} value="Unidades">Unidades</option>
                                        <option {{ $producto->unidad_medida == 'Libras' ? 'selected' : '' }} value="Libras">Libras</option>
                                        <option {{ $producto->unidad_medida == 'Kilos' ? 'selected' : '' }} value="Kilos">Kilos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2" style="margin-bottom: 20px">
                                <input {{ $producto->categoria === 'Aseo' ? 'checked' : '' }} required type="radio" id="control_01"  name="categoria" value="Aseo" >
                                <label class="lradio" for="control_01">
                                    <img src="/img/aseo.png" style="width: 50px" alt="">
                                    <p>Aseo</p>
                                </label>
                            </div>
                            <div class="col-lg-2" style="margin-bottom: 20px">
                                <input {{ $producto->categoria === 'Alimentos' ? 'checked' : '' }} required type="radio" id="control_02" name="categoria" value="Alimentos">
                                <label class="lradio" for="control_02">
                                    <img src="/img/alimentos.png" style="width: 50px" alt="">
                                    <p>Alimentos</p>
                                </label>
                            </div>
                            <div class="col-lg-2" style="margin-bottom: 20px">
                                <input {{ $producto->categoria === 'Bebidas' ? 'checked' : '' }} required type="radio" id="control_03" name="categoria" value="Bebidas">
                                <label class="lradio" for="control_03">
                                    <img src="/img/bebidas.png" style="width: 50px" alt="">
                                    <p>Bebidas</p>
                                </label>
                            </div>
                            <div class="col-lg-2" style="margin-bottom: 20px">
                                <input {{ $producto->categoria === 'Carnes' ? 'checked' : '' }} required type="radio" id="control_05" name="categoria" value="Carnes">
                                <label class="lradio" for="control_05">
                                    <img src="/img/carne.png" style="width: 50px" alt="">
                                    <p>Carnes</p>
                                </label>
                            </div>
                            <div class="col-lg-2" style="margin-bottom: 20px">
                                <input {{ $producto->categoria === 'Farmacia' ? 'checked' : '' }} required type="radio" id="control_07" name="categoria" value="Farmacia">
                                <label class="lradio" for="control_07">
                                    <img src="/img/farmacia.png" style="width: 50px" alt="">
                                    <p>Farmacia</p>
                                </label>
                            </div>
                            <div class="col-lg-2" style="margin-bottom: 20px">
                                <input {{ $producto->categoria === 'Otros' ? 'checked' : '' }} required type="radio" id="control_06" name="categoria" value="Otros">
                                <label class="lradio" for="control_06">
                                    <p>Otros</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label class="imagen_producto" for="imagen">
                            <img id="imagen_previa" style="height: 100px;" src="/imagenes_productos/{{$producto->imagen}}" alt="">
                            Foto del producto
                        </label>
                        <input onchange="cargarImagen()" style="display: none" type="file" id="imagen" name="imagen" class="form-control">
                    </div>
                </div>
                <div class="col-lg-12">
                    @include("notificacion")
                    <button class="btn btn-success">Guardar</button>
                    <a class="btn btn-primary" href="{{route("productos.index")}}">Volver al listado</a>
                </div>
            </form>
            <br><br>
        </div>
    </div>
@endsection
<script>
    function cargarImagen() {
        var input = document.getElementById('imagen');
        var imagenPrevio = document.getElementById('imagen_previa');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagenPrevio.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>