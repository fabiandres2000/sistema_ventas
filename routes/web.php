<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route("home");
});
Route::get("/acerca-de", function () {
    return view("misc.acerca_de");
})->name("acerca_de.index");
Route::get("/soporte", function(){
    return redirect("https://parzibyte.me/blog/contrataciones-ayuda/");
})->name("soporte.index");

Auth::routes([
    "reset" => false,// no pueden olvidar contraseña
]);

Route::get('/home', 'HomeController@index')->name('home');
// Permitir logout con petición get
Route::get("/logout", function () {
    Auth::logout();
    return redirect()->route("home");
})->name("logout");


Route::middleware("auth")
    ->group(function () {
        Route::resource("clientes", "ClientesController");
        Route::resource("usuarios", "UserController")->parameters(["usuarios" => "user"]);
        Route::resource("productos", "ProductosController");
        Route::get("/usuarios-deudores", "UserController@deudores")->name("usuarios.deudores");
        Route::post("/usuarios-abonar", "UserController@abonar")->name("usuarios.abonar");
        Route::get("/ventas/ticket", "VentasController@ticket")->name("ventas.ticket");
        Route::resource("ventas", "VentasController");
        Route::get("/vender", "VenderController@index")->name("vender.index");
        Route::post("/productoDeVenta", "VenderController@agregarProductoVenta")->name("agregarProductoVenta");
        Route::delete("/productoDeVenta", "VenderController@quitarProductoDeVenta")->name("quitarProductoDeVenta");
        Route::post("/actualizarProductoDeVenta", "VenderController@actualizarProductoDeVenta")->name("actualizarProductoDeVenta");
        Route::post("/terminarOCancelarVenta", "VenderController@terminarOCancelarVenta")->name("terminarOCancelarVenta");
        Route::post("/modificarInventarioProducto", "ProductosController@modificarInventarioProducto")->name("modificarInventarioProducto");
        Route::get("/verificarUnidadProducto", "ProductosController@verificarUnidadProducto")->name("verificarUnidadProducto");
    
        Route::get('/leer-peso', 'BalanzaController@leerPeso');

        Route::get('/imprimir-ticket', 'VentasController@ImprimirTicket');
    });


Route::get("/productos-categoria", "ProductosController@productosCategoria")->name("productosCategoria");
