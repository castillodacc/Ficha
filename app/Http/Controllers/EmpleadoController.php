<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\User;
use App\Ficha;
use App\Cliente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
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
        $empleados = Empleado::all();
        return view('empleado.index')->with('empleados', $empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user           = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        if($user->save()) {
            $empleado_datos = $request->except('username', 'password');
            $empleado_datos = array_add($empleado_datos, 'user_id', $user->id);
            $empleado       = Empleado::create($empleado_datos);
            if($empleado) {
                return Response::json([
                    'error' => false,
                    'mensaje' => 'Empleado creado correctamente',
                    'code' => 200
                ], 200);
            }
        }
        return Response::json([
            'error' => true,
            'mensaje' => 'Error. Empleado NO fue creado',
            'code' => 200
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        return view('empleado.edit')->with('empleado', $empleado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        $empleado->user->username = $request->username;
        $empleado->user->password = Hash::make($request->password);
        if($empleado->user->save()) {
            if($empleado->update($request->except('username', 'password'))) {
                return Response::json([
                    'error' => false,
                    'mensaje' => 'Empleado actualizado correctamente',
                    'code' => 200
                ], 200);
            }
        }
        return Response::json([
            'error' => false,
            'mensaje' => 'Error al intentar actualizar empleado',
            'code' => 200
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        if($empleado->delete()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Empleado eliminado correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar eliminar empleado',
                'code' => 200
            ], 200);
        }
    }

    /**
     * Enable the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function enable(Empleado $empleado)
    {
        $empleado->user->activo = TRUE;
        if($empleado->user->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Empleado activado correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar activar empleado',
                'code' => 200
            ], 200);
        }
    }

    /**
     * Disable the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function disable(Empleado $empleado)
    {
        $empleado->user->activo = FALSE;
        if($empleado->user->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Empleado desactivado correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar desactivar empleado',
                'code' => 200
            ], 200);
        }
    }

   public function jornada(Empleado $empleado)
   {
       $clientes = Cliente::all()->pluck('nombre', 'id');

       return view('empleado.jornada')
           ->with('clientes', $clientes)
           ->with('empleado', $empleado);
   }

    public function historial(Empleado $empleado)
    {
        $fichas = Ficha::where('empleado_id','=',$empleado->id)->get();
        return view('empleado.historial')->with('fichas', $fichas);
    }

    public function extras(Empleado $empleado)
    {
        $clientes = Cliente::all();
        return view('empleado.extras')->with('clientes', $clientes);
    }

    public function descanso(Empleado $empleado)
    {
        $clientes = Ficha::all();
        return view('empleado.descanso')->with('clientes', $clientes);
    }

    public function iniciar(Request $request, Empleado $empleado)
    {
        $ficha = new Ficha();
        $ficha->empleado_id = $empleado->id;
        $ficha->cliente_id = $request->cliente;
        if($ficha->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Jornada iniciada',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar iniciar jornada',
                'code' => 200
            ], 200);
        }
    }

}
