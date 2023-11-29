@extends('maestra')
@section("titulo", "Inicio")
@section('contenido')
    @foreach([
    ["productos", "ventas", "vender", "clientes", "usuarios"],
    ] as $modulos)
        <div class="col-12 pb-2">
            <div class="row">
                @foreach($modulos as $modulo)
                    <div class="col-12 col-md-4" style="margin-top: 20px">
                        <div class="card" style="align-items: center;">
                            <img style="height: 129px; width: fit-content; padding: 15px" class="card-img-top" src="{{url("/img/$modulo.png")}}">
                            <div class="card-body">
                                <h5 class="card-title text-center">
                                    {{$modulo === "acerca_de" ? "Acerca de" : ucwords($modulo)}}
                                </h5>
                                <a href="{{route("$modulo.index")}}" class="btn btn-success">
                                    Ir a&nbsp;{{$modulo === "acerca_de" ? "Acerca de" : ucwords($modulo)}}
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
@endsection
