<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
            $pdf = PDF::loadView('reporte.tabla_cliente', compact('fichas'));
            $reporte = $pdf->save('reporte.pdf');
            return Response::json([
                'error' => false,
                'archivo' => '/reporte.pdf',
                'mensaje' => 'todo ok',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => true,
                'archivo' => null,
                'mensaje' => 'Error. No hay información en el rango de fecha seleccionado',
                'code' => 200
            ], 200);
        }
    }

    public function reporteClientes(Request $request)
    {
        $fichas = Ficha::where('estado', '!=', 'en progreso')
                ->whereDate('fecha', '>=', $request->fecha_inicio)
                ->whereDate('fecha', '<=', $request->fecha_fin)
                ->get();
        if($fichas->isNotEmpty()) {
            $pdf = PDF::loadView('reporte.tabla_clientes', compact('fichas'));
            $reporte = $pdf->save('reporte.pdf');
            return Response::json([
                'error' => false,
                'archivo' => '/reporte.pdf',
                'mensaje' => 'todo ok',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => true,
                'archivo' => null,
                'mensaje' => 'Error. No hay información en el rango de fecha seleccionado',
                'code' => 200
            ], 200);
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
            $pdf = PDF::loadView('reporte.tabla_empleado', compact('fichas'));
            $reporte = $pdf->save('reporte.pdf');
            return Response::json([
                'error' => false,
                'archivo' => '/reporte.pdf',
                'mensaje' => 'todo ok',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => true,
                'archivo' => null,
                'mensaje' => 'Error. No hay información en el rango de fecha seleccionado',
                'code' => 200
            ], 200);
        }
    }

    public function reporteEmpleados(Request $request)
    {
        $fichas = Ficha::where('estado', '!=', 'en progreso')
                ->whereDate('fecha', '>=', $request->fecha_inicio)
                ->whereDate('fecha', '<=', $request->fecha_fin)
                ->get();
        if($fichas->isNotEmpty()) {
            $pdf = PDF::loadView('reporte.tabla_empleados', compact('fichas'));
            $reporte = $pdf->save('reporte.pdf');
            return Response::json([
                'error' => false,
                'archivo' => '/reporte.pdf',
                'mensaje' => 'todo ok',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => true,
                'archivo' => null,
                'mensaje' => 'Error. No hay información en el rango de fecha seleccionado',
                'code' => 200
            ], 200);
        }
    }

}
