<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ClienteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('cliente.index')->with('clientes', $clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cliente.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cliente = Cliente::create($request->all());
        if($cliente) {
            return Response::json([
            'error' => false,
            'mensaje' => 'Cliente creado correctamente',
            'code' => 200
            ], 200);
        }
        return Response::json([
            'error' => true,
            'mensaje' => 'Error. Cliente NO fue creado',
            'code' => 200
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('cliente.edit')->with('cliente',$cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente->nombre = $request->nombre;
        if($cliente->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Cliente fue editado correctamente',
                'code' => 200
            ], 200);
        }
        return Response::json([
            'error' => true,
            'mensaje' => 'Error al intentar editar el nombre del cliente',
            'code' => 200
        ], 500);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        if($cliente->delete()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Cliente eliminado correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar eliminadr al cliente',
                'code' => 200
            ], 200);
        }
    }
}
