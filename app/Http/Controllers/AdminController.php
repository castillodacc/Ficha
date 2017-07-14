<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminController extends Controller
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
        $this->authorize('view', Auth::user()->admin);
        $administradores = Admin::all();
        return view('admin.index')->with('administradores', $administradores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Admin::class);
        return view('admin.create');
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
        $user->is_admin = TRUE;
        if($user->save()) {
            $admin_datos = $request->except('username', 'password');
            $admin_datos = array_add($admin_datos, 'user_id', $user->id);
            $admin = Admin::create($admin_datos);
            if($admin) {
                return Response::json([
                    'error' => false,
                    'mensaje' => 'Administrador creado correctamente',
                    'code' => 200
                ], 200);
            }
        }
        return Response::json([
            'error' => true,
            'mensaje' => 'Error. Administrador NO fue creado',
            'code' => 200
            ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $this->authorize('edit', Auth::user()->admin);
        return view('admin.edit')->with('admin', $admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $admin->user->username = $request->username;
        $admin->user->password = Hash::make($request->password);
        if($admin->user->save()) {
            if($admin->update($request->except('username', 'password'))) {
                return Response::json([
                    'error' => false,
                    'mensaje' => 'Administrador actualizado correctamente',
                    'code' => 200
                ], 200);
            }
        }
        return Response::json([
            'error' => false,
            'mensaje' => 'Error al intentar actualizar administrador',
            'code' => 200
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if($admin->delete()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Administrador eliminado correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar eliminar administrador',
                'code' => 200
            ], 200);
        }
    }

    /**
     * Enable the specified resource.
     *
     * @param  \App\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function enable(Admin $admin)
    {
        $admin->user->activo = TRUE;
        if($admin->user->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Administrador activado correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar activar administrador',
                'code' => 200
            ], 200);
        }
    }

    /**
     * Disable the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function disable(Admin $admin)
    {
        $admin->user->activo = FALSE;
        if($admin->user->save()) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Administrador desactivado correctamente',
                'code' => 200
            ], 200);
        } else {
            return Response::json([
                'error' => false,
                'mensaje' => 'Error al intentar desactivar administrador',
                'code' => 200
            ], 200);
        }
    }
}
