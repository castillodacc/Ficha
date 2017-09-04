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
        $horas_jornada = "";
        if($fichas->isNotEmpty()) {
            $hora             = Carbon::today();
            $tiempo_trabajado = Carbon::today();
            $tiempo_extras     = Carbon::today();
            $i = 1;
            foreach($fichas as $ficha) {
                if($i === 1) {
                    $horas_jornada = $ficha->tiempo_por_trabajar;
                    $i++;
                }
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
            $horas_trabajadas = $tiempo_trabajado->diff($hora)->format('%Dd:%Hh:%Im');
            $horas_extras     = $tiempo_extras->diff($hora)->format('%Dd:%Hh:%Im');

            $tiempo_por_trabajar = explode(":", $horas_jornada);
            $horas_t             = explode(":", $horas_trabajadas);

            $d_t = substr($horas_t[0], 0, strpos($horas_t[0], 'd')) * 24;
            $h_t = substr($horas_t[1], 0, strpos($horas_t[1], 'h'));
            $m_t = substr($horas_t[2], 0, strpos($horas_t[2], 'm')) / 60;
            $porcentaje_jornada  = number_format((($d_t+$h_t+$m_t) / ($tiempo_por_trabajar[0] + ($tiempo_por_trabajar[1] / 60))),
                                                 1
            );

            $pdf = PDF::loadView('reporte.tabla_cliente',
                                 compact('fichas',
                                         'horas_trabajadas',
                                         'horas_extras',
                                         'porcentaje_jornada'
                                 )
            );
            return $pdf->stream('reporte.pdf', array("Attachment" => false));
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
        $horas_jornada = "";
        if($fichas->isNotEmpty()) {
            $hora             = Carbon::today();
            $tiempo_trabajado = Carbon::today();
            $tiempo_extras    = Carbon::today();
            $i = 1;
            foreach($fichas as $ficha) {
                if($i === 1) {
                    $horas_jornada = $ficha->tiempo_por_trabajar;
                    $i++;
                }
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
            $clientes = Ficha::select('cliente_id')
                       ->where('estado', '!=', 'en progreso')
                       ->whereDate('fecha', '>=', $request->fecha_inicio)
                       ->whereDate('fecha', '<=', $request->fecha_fin)
                       ->groupBy('cliente_id')
                       ->get();

            $fecha_inicio     = $request->fecha_inicio;
            $fecha_fin        = $request->fecha_fin;
            $horas_trabajadas = $tiempo_trabajado->diff($hora)->format('%Dd:%Hh:%Im');
            $horas_extras     = $tiempo_extras->diff($hora)->format('%Dd:%Hh:%Im');

            $tiempo_por_trabajar = explode(":", $horas_jornada);
            $horas_t             = explode(":", $horas_trabajadas);

            $d_t = substr($horas_t[0], 0, strpos($horas_t[0], 'd')) * 24;
            $h_t = substr($horas_t[1], 0, strpos($horas_t[1], 'h'));
            $m_t = substr($horas_t[2], 0, strpos($horas_t[2], 'm')) / 60;
            $porcentaje_jornada  = number_format((($d_t+$h_t+$m_t) / ($tiempo_por_trabajar[0] + ($tiempo_por_trabajar[1] / 60))),
                                                 1
            );

            $pdf = PDF::loadView('reporte.tabla_clientes',
                                 compact('fichas',
                                         'horas_trabajadas',
                                         'horas_extras',
                                         'fecha_inicio',
                                         'fecha_fin',
                                         'clientes',
                                         'porcentaje_jornada'
                                 )
            );
            return $pdf->stream('reporte.pdf', array("Attachment" => false));
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
        $horas_jornada = "";
        if($fichas->isNotEmpty()) {
            $hora             = Carbon::today();
            $tiempo_trabajado = Carbon::today();
            $tiempo_extras    = Carbon::today();
            $i = 1;
            foreach($fichas as $ficha) {
                if($i === 1) {
                    $horas_jornada = $ficha->tiempo_por_trabajar;
                    $i++;
                }
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
            $horas_trabajadas = $tiempo_trabajado->diff($hora)->format('%Dd:%Hh:%Im');
            $horas_extras     = $tiempo_extras->diff($hora)->format('%Dd:%Hh:%Im');

            $tiempo_por_trabajar = explode(":", $horas_jornada);
            $horas_t             = explode(":", $horas_trabajadas);

            $d_t = substr($horas_t[0], 0, strpos($horas_t[0], 'd')) * 24;
            $h_t = substr($horas_t[1], 0, strpos($horas_t[1], 'h'));
            $m_t = substr($horas_t[2], 0, strpos($horas_t[2], 'm')) / 60;
            $porcentaje_jornada  = number_format((($d_t+$h_t+$m_t) / ($tiempo_por_trabajar[0] + ($tiempo_por_trabajar[1] / 60))),
                                                 1
            );

            $pdf = PDF::loadView('reporte.tabla_empleado',
                                 compact('fichas',
                                         'horas_trabajadas',
                                         'horas_extras',
                                         'porcentaje_jornada'
                                 )
            );
            return $pdf->stream('reporte.pdf', array("Attachment" => false));
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
        $horas_jornada = "";
        if($fichas->isNotEmpty()) {
            $hora             = Carbon::today();
            $tiempo_trabajado = Carbon::today();
            $tiempo_extras    = Carbon::today();
            $i = 1;
            foreach($fichas as $ficha) {
                if($i === 1) {
                    $horas_jornada = $ficha->tiempo_por_trabajar;
                    $i++;
                }
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
            $empleados = Ficha::select('empleado_id')
                       ->where('estado', '!=', 'en progreso')
                       ->whereDate('fecha', '>=', $request->fecha_inicio)
                       ->whereDate('fecha', '<=', $request->fecha_fin)
                       ->groupBy('empleado_id')
                       ->get();

            $fecha_inicio        = $request->fecha_inicio;
            $fecha_fin           = $request->fecha_fin;
            $horas_trabajadas    = $tiempo_trabajado->diff($hora)->format('%Dd:%Hh:%Im');
            $horas_extras        = $tiempo_extras->diff($hora)->format('%Dd:%Hh:%Im');

            $tiempo_por_trabajar = explode(":", $horas_jornada);
            $horas_t             = explode(":", $horas_trabajadas);

            $d_t = substr($horas_t[0], 0, strpos($horas_t[0], 'd')) * 24;
            $h_t = substr($horas_t[1], 0, strpos($horas_t[1], 'h'));
            $m_t = substr($horas_t[2], 0, strpos($horas_t[2], 'm')) / 60;

            $porcentaje_jornada  = number_format((($d_t+$h_t+$m_t) / ($tiempo_por_trabajar[0] + ($tiempo_por_trabajar[1] / 60))),
                                                 1
            );
            $pdf = PDF::loadView('reporte.tabla_empleados',
                                 compact('fichas',
                                         'horas_trabajadas',
                                         'horas_extras',
                                         'fecha_inicio',
                                         'fecha_fin',
                                         'empleados',
                                         'porcentaje_jornada'
                                 )
            );
            return $pdf->stream('reporte.pdf', array("Attachment" => false));
        } else {
            return Redirect::back()->withErrors(['Error. No hay información en el rango de fecha seleccionado']);
        }
    }

}
