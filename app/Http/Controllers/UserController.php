<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Cliente;

use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("usuarios.usuarios_index", ["usuarios" => User::all()]);
    }

    public function deudores()
    {
        $resultado = Cliente::join("fiados", "clientes.id", "=", "fiados.id_cliente")
        ->selectRaw("clientes.*, SUM(fiados.total_fiado) as total_fiado")
        ->groupBy('clientes.id')
        ->get();

        $clientes_deben = [];

        foreach ($resultado as $item) {
            $abonado = Cliente::join("abonos_fiados", "clientes.id", "=", "abonos_fiados.id_cliente")
            ->selectRaw("clientes.id, SUM(abonos_fiados.valor_abonado) as total_abonado")
            ->where("clientes.id", $item->id)
            ->groupBy('clientes.id')
            ->get();

            if(count($abonado) == 0){
                $total_abonado = 0;
            }else{
                $total_abonado = $abonado[0]->total_abonado;
            }

            $item->total_abonado = $total_abonado;
            $item->total_deuda = $item->total_fiado - $item->total_abonado;

            if($item->total_deuda > 1){
                array_push($clientes_deben, $item);
            }
        }

        return view("usuarios.usuarios_deudores", ["clientes_deudores" => $clientes_deben]);
    }

    public function abonar(Request $request)
    {

        $datos = [
            'id_cliente' => $request->input('id_cliente'),
            'valor_abonado' => $request->input('total_abonar'),
            'fecha_abono' => date("d-m-Y H:i:s")
        ];

        DB::connection('mysql')->table('abonos_fiados')->insert(
            $datos 
        );

        return redirect('/usuarios-deudores');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("usuarios.usuarios_create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new User($request->input());
        $usuario->password = Hash::make($usuario->password);
        $usuario->saveOrFail();
        return redirect()->route("usuarios.index")->with("mensaje", "Usuario guardado");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->password = "";
        return view("usuarios.usuarios_edit", ["usuario" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->fill($request->input());
        $user->password = Hash::make($user->password);
        $user->saveOrFail();
        return redirect()->route("usuarios.index")->with("mensaje", "Usuario actualizado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("usuarios.index")->with("mensaje", "Usuario eliminado");
    }
}
