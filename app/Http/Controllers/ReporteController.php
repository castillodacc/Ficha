<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Cliente;
use App\Empleado;
use App\Ficha;
use PDF;
use Carbon\Carbon;

class ReporteController extends Controller
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
        return view('reporte.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showFormReporteCliente()
    {
        $clientes = Cliente::all()->pluck('nombre', 'id');
        return view('reporte.cliente')
            ->with('clientes', $clientes);
    }

    public function showFormReporteClientes()
    {
        $clientes = Cliente::all()->pluck('nombre', 'id');
        return view('reporte.clientes')
            ->with('clientes', $clientes);
    }

    public function showFormReporteEmpleado()
    {
        $empleados = Empleado::all()->pluck('nombre', 'id');
        return view('reporte.empleado')
            ->with('empleados', $empleados);
    }

    public function showFormReporteEmpleados()
    {
        $empleados = Empleado::all()->pluck('nombre', 'id');
        return view('reporte.empleados')
            ->with('empleados', $empleados);
    }

    public function reporteCliente(Request $request)
    {
        $fichas = Ficha::where('estado', '!=', 'en progreso')
                ->whereDate('fecha', '>=', $request->fecha_inicio)
                ->whereDate('fecha', '<=', $request->fecha_fin)
                ->where('cliente_id', $request->cliente)
                ->get();
        if($fichas->isNotEmpty()) {
            $hora             = Carbon::today();
            $tiempo_trabajado = Carbon::today();
            $tiempo_extras     = Carbon::today();
            foreach($fichas as $ficha) {
                $horas_t = $ficha->getTotalHorasTrabajadas();
                if($horas_t) {
                    $tiempo_t = explode(":", $horas_t);
                    $tiempo_trabajado->addHours($tiempo_t[0]);
                    $tiempo_trabajado->addMinutes($tiempo_t[1]);

                    $horas_e = $ficha->getTotalHorasExtras();
                    if($horas_e) {
                        $tiempo_e = explode(":", $horas_e);
                        $tiempo_extras->addHours($tiempo_e[0]);
                        $tiempo_extras->addMinutes($tiempo_e[1]);
                    }
                }
            }
            $horas_trabajadas = $tiempo_trabajado->diff($hora)->format('%H:%i');
            $horas_extras     = $tiempo_extras->diff($hora)->format('%H:%i');
            $pdf = PDF::loadView('reporte.tabla_cliente', compact('fichas', 'horas_trabajadas', 'horas_extras'));
            return $pdf->stream('reporte.pdf');
        } else {
            return Redirect::back()->withErrors(['Error. No hay información en el rango de fecha seleccionado']);
        }
    }

    public function reporteClientes(Request $request)
    {
        $fichas = Ficha::where('estado', '!=', 'en progreso')
                ->whereDate('fecha', '>=', $request->fecha_inicio)
                ->whereDate('fecha', '<=', $request->fecha_fin)
                ->get();
        if($fichas->isNotEmpty()) {
            $hora             = Carbon::today();
            $tiempo_trabajado = Carbon::today();
            $tiempo_extras     = Carbon::today();
            foreach($fichas as $ficha) {
                $horas_t = $ficha->getTotalHorasTrabajadas();
                if($horas_t) {
                    $tiempo_t = explode(":", $horas_t);
                    $tiempo_trabajado->addHours($tiempo_t[0]);
                    $tiempo_trabajado->addMinutes($tiempo_t[1]);

                    $horas_e = $ficha->getTotalHorasExtras();
                    if($horas_e) {
                        $tiempo_e = explode(":", $horas_e);
                        $tiempo_extras->addHours($tiempo_e[0]);
                        $tiempo_extras->addMinutes($tiempo_e[1]);
                    }
                }
            }
            $horas_trabajadas = $tiempo_trabajado->diff($hora)->format('%H:%i');
            $horas_extras     = $tiempo_extras->diff($hora)->format('%H:%i');
            $pdf = PDF::loadView('reporte.tabla_clientes', compact('fichas', 'horas_trabajadas', 'horas_extras'));
            return $pdf->stream('reporte.pdf');
        } else {
            return Redirect::back()->withErrors(['Error. No hay información en el rango de fecha seleccionado']);
        }
    }

    public function reporteEmpleado(Request $request)
    {
        $fichas = Ficha::where('estado', '!=', 'en progreso')
                ->whereDate('fecha', '>=', $request->fecha_inicio)
                ->whereDate('fecha', '<=', $request->fecha_fin)
                ->where('empleado_id', $request->empleado)
                ->get();
        if($fichas->isNotEmpty()) {
            $hora             = Carbon::today();
            $tiempo_trabajado = Carbon::today();
            $tiempo_extras     = Carbon::today();
            foreach($fichas as $ficha) {
                $horas_t = $ficha->getTotalHorasTrabajadas();
                if($horas_t) {
                    $tiempo_t = explode(":", $horas_t);
                    $tiempo_trabajado->addHours($tiempo_t[0]);
                    $tiempo_trabajado->addMinutes($tiempo_t[1]);

                    $horas_e = $ficha->getTotalHorasExtras();
                    if($horas_e) {
                        $tiempo_e = explode(":", $horas_e);
                        $tiempo_extras->addHours($tiempo_e[0]);
                        $tiempo_extras->addMinutes($tiempo_e[1]);
                    }
                }
            }
            $horas_trabajadas = $tiempo_trabajado->diff($hora)->format('%H:%i');
            $horas_extras     = $tiempo_extras->diff($hora)->format('%H:%i');
            $pdf = PDF::loadView('reporte.tabla_empleado', compact('fichas', 'horas_trabajadas', 'horas_extras'));
            return $pdf->stream('reporte.pdf');
        } else {
            return Redirect::back()->withErrors(['Error. No hay información en el rango de fecha seleccionado']);
       }
    }

    public function reporteEmpleados(Request $request)
    {
        $fichas = Ficha::where('estado', '!=', 'en progreso')
                ->whereDate('fecha', '>=', $request->fecha_inicio)
                ->whereDate('fecha', '<=', $request->fecha_fin)
                ->get();
        if($fichas->isNotEmpty()) {
            $hora             = Carbon::today();
            $tiempo_trabajado = Carbon::today();
            $tiempo_extras     = Carbon::today();
            foreach($fichas as $ficha) {
                $horas_t = $ficha->getTotalHorasTrabajadas();
                if($horas_t) {
                    $tiempo_t = explode(":", $horas_t);
                    $tiempo_trabajado->addHours($tiempo_t[0]);
                    $tiempo_trabajado->addMinutes($tiempo_t[1]);

                    $horas_e = $ficha->getTotalHorasExtras();
                    if($horas_e) {
                        $tiempo_e = explode(":", $horas_e);
                        $tiempo_extras->addHours($tiempo_e[0]);
                        $tiempo_extras->addMinutes($tiempo_e[1]);
                    }
                }
            }
            $horas_trabajadas = $tiempo_trabajado->diff($hora)->format('%H:%i');
            $horas_extras     = $tiempo_extras->diff($hora)->format('%H:%i');
            $pdf = PDF::loadView('reporte.tabla_empleados', compact('fichas', 'horas_trabajadas', 'horas_extras'));
            return $pdf->stream('reporte.pdf');
        } else {
            return Redirect::back()->withErrors(['Error. No hay información en el rango de fecha seleccionado']);
        }
    }

}
