<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Producto;
use App\ProductoVendido;
use App\Venta;
use Illuminate\Http\Request;

use DB;

class VenderController extends Controller
{

    public function terminarOCancelarVenta(Request $request)
    {
        if ($request->input("accion") == "terminar") {
            return $this->terminarVenta($request);
        } else {
            return $this->cancelarVenta();
        }
    }

    public function terminarVenta(Request $request)
    {
        $venta = new Venta();
        $venta->id_cliente =  $request->input('id_cliente');
        $venta->total_pagar =  $request->input('total_pagar');
        $venta->total_dinero =  $request->input('total_dinero');
        $venta->total_fiado =  $request->input('total_fiado');
        $venta->total_vueltos =  $request->input('total_vueltos');
        $venta->saveOrFail();

        if($venta->total_fiado > 0){
            $this->guardarFiado($venta->id_cliente, $venta->id,  $venta->total_fiado);
        }

        $idVenta = $venta->id;
        $productos = $this->obtenerProductos();

        // Recorrer carrito de compras
        foreach ($productos as $producto) {
            // El producto que se vende...
            $productoVendido = new ProductoVendido();
            $productoVendido->fill([
                "id_venta" => $idVenta,
                "descripcion" => $producto->descripcion,
                "codigo_barras" => $producto->codigo_barras,
                "precio" => $producto->precio_venta,
                "cantidad" => $producto->cantidad,
                "unidad" => $producto->unidad_medida== "Kilos" ? "Kg" : ($producto->unidad_medida == "Libras" ? "Lb" : "Und")
            ]);
            // Lo guardamos
            $productoVendido->saveOrFail();
            // Y restamos la existencia del original
            $productoActualizado = Producto::find($producto->id);
            $productoActualizado->existencia -= $productoVendido->cantidad;
            $productoActualizado->saveOrFail();
        }
        $this->vaciarProductos();
        return redirect()
            ->route("vender.index")
            ->with("mensaje", "Venta terminada");
    }

    public function guardarFiado($id_cliente, $id_factura, $total_fiado){
        $datos = [
            'id_cliente' => $id_cliente,
            'id_factura' => $id_factura,
            'total_fiado' => $total_fiado
        ];

        DB::connection('mysql')->table('fiados')->insert(
            $datos 
        );
    }

    private function obtenerProductos()
    {
        $productos = session("productos");
        if (!$productos) {
            $productos = [];
        }
        return $productos;
    }

    private function vaciarProductos()
    {
        $this->guardarProductos(null);
    }

    private function guardarProductos($productos)
    {
        session(["productos" => $productos]);
    }

    public function cancelarVenta()
    {
        $this->vaciarProductos();
        return redirect()
            ->route("vender.index")
            ->with("mensaje", "Venta cancelada");
    }

    public function quitarProductoDeVenta(Request $request)
    {
        $indice = $request->post("indice");
        $productos = $this->obtenerProductos();
        array_splice($productos, $indice, 1);
        $this->guardarProductos($productos);
        if(count($productos) == 0){
            $this->vaciarProductos();
        }
        return redirect()
            ->route("vender.index");
    }

    public function agregarProductoVenta(Request $request)
    {
        $codigo = $request->post("codigo");
        $cantidad = $request->post("cantidad");
        $producto = Producto::where("codigo_barras", "=", $codigo)->first();
        if (!$producto) {
            return redirect()
                ->route("vender.index")
                ->with("mensaje", "Producto no encontrado");
        }
        $this->agregarProductoACarrito($producto, $cantidad);
        return redirect()
            ->route("vender.index");
    }

    private function agregarProductoACarrito($producto, $cantidad)
    {
        if ($producto->existencia <= 0) {
            return redirect()->route("vender.index")
                ->with([
                    "mensaje" => "No hay existencias del producto",
                    "tipo" => "danger"
                ]);
        }

        $productos = $this->obtenerProductos();
        $posibleIndice = $this->buscarIndiceDeProducto($producto->codigo_barras, $productos);
        // Es decir, producto no fue encontrado
        if ($posibleIndice === -1) {
            if ($cantidad <= $producto->existencia) {
                $producto->cantidad = $cantidad;
                $producto->precio_total = round($producto->cantidad * $producto->precio_venta);
                array_push($productos, $producto);
            }else{
                return redirect()->route("vender.index")
                ->with([
                    "mensaje" => "No se pueden agregar más productos de este tipo, se quedarían sin existencia",
                    "tipo" => "danger"
                ]);
            }
        } else {
            if ($productos[$posibleIndice]->cantidad + $cantidad > $producto->existencia) {
                return redirect()->route("vender.index")
                    ->with([
                        "mensaje" => "No se pueden agregar más productos de este tipo, se quedarían sin existencia",
                        "tipo" => "danger"
                    ]);
            }
            $productos[$posibleIndice]->cantidad += $cantidad;
            $productos[$posibleIndice]->precio_total =  round($productos[$posibleIndice]->cantidad * $productos[$posibleIndice]->precio_venta);
        }
        $this->guardarProductos($productos);
    }

    private function buscarIndiceDeProducto(string $codigo, array &$productos)
    {
        foreach ($productos as $indice => $producto) {
            if ($producto->codigo_barras === $codigo) {
                return $indice;
            }
        }
        return -1;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total = 0;
        foreach ($this->obtenerProductos() as $producto) {
            $total += round($producto->cantidad * $producto->precio_venta);
        }

        return view("vender.vender",
            [
                "total" => $total,
                "clientes" => Cliente::all(),
            ]);
    }
}
