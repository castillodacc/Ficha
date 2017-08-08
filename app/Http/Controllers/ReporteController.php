<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;
use App\Empleado;

class ReporteController extends Controller
{
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

}
