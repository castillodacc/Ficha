<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display form to update password.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        return view("password.update");
    }

    /**
     * Save password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $actualizado = $request->user()->fill([
            'password' => Hash::make($request->newPassword)
        ])->save();
        if($actualizado) {
            return Response::json([
                'error' => false,
                'mensaje' => 'Contraseña actualizada correctamente',
                'code' => 200
            ], 200);
        }
        return Response::json([
            'error' => true,
            'mensaje' => 'Error al actualizar contraseña',
            'code' => 200
        ], 200);
    }

}
