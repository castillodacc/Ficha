<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Provincia;
use App\Poblacion;

class EmpresaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        if (!\Auth::user()['is_admin']) {
            return redirect('/');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Empresa::all();
        return view('empresa.index', compact('empresa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = new Empresa();
        $provincias = Provincia::orderBy('nombre')->pluck('nombre', 'id');
        $poblaciones = [];
        return view('empresa.form', compact('empresa', 'provincias', 'poblaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'telefono' => 'nullable|string',
            'contacto' => 'nullable|string',
            'correo' => 'nullable|email',
            'direccion' => 'nullable|string'
        ]);
        Empresa::create($request->all());
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
        $empresa = Empresa::findOrFail($id);
        $empresa->provincia_id = $empresa->poblacion->provincia_id;
        $poblaciones = [];
        if ($empresa->poblacion_id) {
            $poblaciones = Poblacion::where('provincia_id', $empresa->poblacion->provincia_id)
            ->orderBy('nombre')
            ->pluck('nombre', 'id');
        }
        $provincias = Provincia::orderBy('nombre')->pluck('nombre', 'id');
        return view('empresa.form', compact('empresa', 'provincias', 'poblaciones'));
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
        $this->validate($request, [
            'nombre' => 'required|string',
            'telefono' => 'nullable|string',
            'contacto' => 'nullable|string',
            'correo' => 'nullable|email',
            'direccion' => 'nullable|string'
        ]);
        Empresa::findOrFail($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Empresa::findOrFail($id)->delete();
    }
}
