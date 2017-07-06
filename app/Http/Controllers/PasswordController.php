<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
        return Response::json([
            'error' => false,
            'mensaje' => 'Contraseña actualizada correctamente.',
            'code' => 200
        ], 200);
    }

}
