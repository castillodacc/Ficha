<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\User;
use App\Ficha;
use App\Cliente;
use Carbon\Carbon;

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
        $clientes = Cliente::where('activo', TRUE)->pluck('nombre', 'id');
        return view('empleado.create')
            ->with('clientes', $clientes);
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
        $clientes = Cliente::where('activo', TRUE)->pluck('nombre', 'id');
        return view('empleado.edit')
            ->with('clientes', $clientes)
            ->with('empleado', $empleado);
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
        if($empleado->user->save()) {
            if($empleado->update($request->except('username'))) {
                return Response::json([
                    'error' => false,
                    'mensaje' => 'Empleado actualizado correctamente',
                    'code' => 200
                ], 200);
            }
        }
        return Response::json([
            'error' => true,
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
                'error' => true,
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
                'error' => true,
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
                'error' => true,
                'mensaje' => 'Error al intentar desactivar empleado',
                'code' => 200
            ], 200);
        }
    }

    public function historial(Empleado $empleado)
    {
        $fichas = Ficha::where('empleado_id','=',$empleado->id)
                ->where('estado','<>', 'en progreso')
                ->get();
        return view('empleado.historial')->with('fichas', $fichas);
    }

   public function showFormIniciarJornada(Empleado $empleado)
   {
       $clientes = Cliente::all()->pluck('nombre', 'id');

       return view('empleado.jornada.iniciar_jornada')
           ->with('empleado', $empleado);
   }

   public function showFormFinalizarJornada(Empleado $empleado)
   {
       return view('empleado.jornada.finalizar_jornada')
           ->with('empleado', $empleado);
   }

    public function iniciarJornada(Request $request, Empleado $empleado)
    {
        $ficha = new Ficha();
        $ficha->empleado_id = $empleado->id;
        $ficha->cliente_id = $empleado->cliente_id;
        if($ficha->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Jornada iniciada',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => true,
                'mensaje' => 'Error al intentar iniciar jornada',
                'code' => 200
            ], 200);
        }
    }

    public function finalizarJornada(Request $request, Empleado $empleado)
    {
        $ficha = Ficha::where('empleado_id',$empleado->id)
               ->where('estado','en progreso')->get()->first();
        if($request->observaciones) {
            $ficha->observaciones = $request->observaciones;
        }
        $ficha->estado = "cerrado";
        $ficha->hora_fin = Carbon::now()->format('H:i');
        if($ficha->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Jornada cerrada correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => true,
                'mensaje' => 'Error al cerrar jornada',
                'code' => 200
            ], 200);
        }
    }

    public function showFormIniciarDescanso(Empleado $empleado)
    {
        return view('empleado.jornada.iniciar_descanso')
            ->with('empleado', $empleado);
    }

    public function showFormFinalizarDescanso(Empleado $empleado)
    {

        return view('empleado.jornada.finalizar_descanso')
            ->with('empleado', $empleado);
    }

    public function iniciarDescanso(Request $request, Empleado $empleado)
    {
        $ficha = Ficha::where('empleado_id',$empleado->id)
                         ->where('estado','en progreso')->get()->first();
        $ficha->hora_inicio_comida = Carbon::now()->format('H:i');
        if($ficha->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Tiempo de descanso iniciado correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => true,
                'mensaje' => 'Tiempo de descanso finalizado correctamente',
                'code' => 200
            ], 200);
        }
    }

    public function finalizarDescanso(Request $request, Empleado $empleado)
    {
        $ficha = Ficha::where('empleado_id',$empleado->id)
               ->where('estado','en progreso')->get()->first();
        $ficha->hora_fin_comida = Carbon::now()->format('H:i');
        if($ficha->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Tiempo de descanso finalizado correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => true,
                'mensaje' => 'Error al finalizar tiempo de descanso',
                'code' => 200
            ], 200);
        }
    }

    public function showFormIniciarHorasExtras(Empleado $empleado)
    {
        return view('empleado.jornada.iniciar_extras')
            ->with('empleado', $empleado);
    }

    public function iniciarHorasExtras(Request $request, Empleado $empleado)
    {
        $ficha = Ficha::where('empleado_id',$empleado->id)
                         ->where('estado','en progreso')->get()->first();
        $ficha->hora_fin = $empleado->jornada->hora_fin_jornada;
        $ficha->hora_inicio_extras = $empleado->jornada->hora_fin_jornada;
        if($ficha->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Horas extras iniciadas correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => true,
                'mensaje' => 'Error al iniciar horas extras',
                'code' => 200
            ], 200);
        }
    }

        public function showFormFinalizarHorasExtras(Empleado $empleado)
    {
        return view('empleado.jornada.finalizar_extras')
            ->with('empleado', $empleado);
    }

    public function finalizarHorasExtras(Request $request, Empleado $empleado)
    {
        $ficha = Ficha::where('empleado_id',$empleado->id)
                         ->where('estado', 'en progreso')->get()->first();
        $ficha->hora_fin_extras = Carbon::now()->format('H:i');
        $ficha->estado = 'cerrado';
        if($ficha->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Horas extras finalizadas correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => true,
                'mensaje' => 'Error al finalizar horas extras',
                'code' => 200
            ], 200);
        }
    }

}
