<?php

namespace App\Http\Controllers;

use App\Jornada;
use App\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;


class JornadaController extends Controller
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
        $jornadas = Jornada::all();
        return view('jornada.index')->with('jornadas', $jornadas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jornada.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inicio = Carbon::createFromFormat('H:i', $request->hora_inicio_jornada);
        $fin    = Carbon::createFromFormat('H:i', $request->hora_fin_jornada);
        $data   = $request->all();
        $data['horas_laborales'] = $inicio->diff($fin)->format('%H:%I');

        $jornada = Jornada::create($data);
        if($jornada) {
            return Response::json([
            'error' => false,
            'mensaje' => 'Jornada creada correctamente',
            'code' => 200
            ], 200);
        }
        return Response::json([
            'error' => true,
            'mensaje' => 'Error al intentar crear jornada',
            'code' => 200
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function show(Jornada $jornada)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function edit(Jornada $jornada)
    {
        return view('jornada.edit')->with('jornada', $jornada);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jornada $jornada)
    {
        $data = $request->all();
        $data['horas_extras'] = $request->input('horas_extras', false);
        $data['hora_comida']  = $request->input('hora_comida', false);
        if($jornada->update($data)) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Jornada actualizada correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar actualizar la jornada',
                'code' => 200
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jornada $jornada)
    {
        if($jornada->delete()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Jornada eliminada correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar eliminar la jornada',
                'code' => 200
            ], 200);
        }
    }

    /**
     * enable the specified resource.
     *
     * @param  \App\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function enable(Jornada $jornada)
    {
        $jornada->activa = TRUE;
        if($jornada->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Jornada activada correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar activar la jornada',
                'code' => 200
            ], 200);
        }
    }

    /**
     * disable the specified resource.
     *
     * @param  \App\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function disable(Jornada $jornada)
    {
        $jornada->activa = FALSE;
        if($jornada->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Jornada desactivada correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar desactivar la jornada',
                'code' => 200
            ], 200);
        }
    }

    /**
     * Display a listing of the empleados to add
     *
     * @param  \App\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function empleados(Jornada $jornada)
    {
        $empleados_por_asignar = Empleado::where('jornada_id','=',null)->pluck('nombre', 'id');
        $empleados_asignados = Empleado::where('jornada_id','=', $jornada->id)->get();

        $jornadas = Jornada::all();
        return view('jornada.empleados')
            ->with('empleados_asignados', $empleados_asignados)
            ->with('empleados_por_asignar', $empleados_por_asignar)
            ->with('jornada', $jornada);
    }

        /**
     * remove the specified resource.
     *
     * @param  \App\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function removerEmpleados(Request $request, Jornada $jornada)
    {
        $empleado = Empleado::find($request->empleado);
        $empleado->jornada()->dissociate();
        if($empleado->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Empleado removido correctamente:'. $empleado->nombre,
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar remover el empleado'. $empleado->nombre,
                'code' => 200
            ], 200);
        }
    }

            /**
     * remove the specified resource.
     *
     * @param  \App\Jornada  $jornada
     * @return \Illuminate\Http\Response
     */
    public function agregarEmpleados(Request $request, Jornada $jornada)
    {
        $empleado = Empleado::find($request->empleado);
        $empleado->jornada()->associate($jornada);
        if($empleado->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Empleado agregado correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar agregar empleado',
                'code' => 200
            ], 200);
        }
    }


}
