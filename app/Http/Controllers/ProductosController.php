<?php
namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;

use DB;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("productos.productos_index", ["productos" => Producto::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("productos.productos_create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo_barras' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'existencia' => 'required|numeric',
            'unidad_medida' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $imageName = time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('imagenes_productos'), $imageName);
        } else {
            $imageName = null;
        }

        $producto = new Producto($request->except('imagen'));
        $producto->imagen = $imageName;
        $producto->saveOrFail();

        return redirect()->route("productos.create");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        return view("productos.productos_edit", ["producto" => $producto]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $producto->fill($request->input());
        $producto->saveOrFail();
        return redirect()->route("productos.index")->with("mensaje", "Producto actualizado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route("productos.index")->with("mensaje", "Producto eliminado");
    }

    public function productosCategoria(Request $request){
        $productos = DB::connection('mysql')->table('productos')
        ->get();
        return response()->json($productos);
    }

    public function modificarInventarioProducto(Request $request){

        $cantidad_disponible = $request->input('cantidad_disponible');
        $precio_compra = $request->input('precio_compra');
        $precio_venta = $request->input('precio_venta');
        $nueva_cantidad = $request->input('nueva_cantidad');
        $codigo_producto = $request->input('codigo_producto');

        $nueva_cantidad_disponible = $cantidad_disponible + $nueva_cantidad;

        
        DB::connection('mysql')->table('productos')
        ->where('codigo_barras', $codigo_producto)
        ->update([
            'existencia' => $nueva_cantidad_disponible,
            'precio_compra' => $precio_compra,
            'precio_venta' => $precio_venta
        ]);

        return redirect()->route("productos.index")->with("mensaje", "Producto actualizado");
    }

    public function verificarUnidadProducto(Request $request){
        $codigo = $request->input('codigo');

        $producto = DB::connection('mysql')->table('productos')
        ->where('codigo_barras', $codigo)
        ->first();

        if($producto == null){
            return 0;
        }else{
            return response()->json($producto);
        }

    }


    public function alert(){
        return view("productos.productos_alert", ["productos" =>  Producto::where('existencia', '<', 10)->get()]);
    }
}
