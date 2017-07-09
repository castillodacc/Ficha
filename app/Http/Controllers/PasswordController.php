<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Validator;
use Auth;
use App\User;

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

        $messages = [
            'current_password.required' => 'Ingrese contraseña actual',
            'password.required' => 'Ingrese contraseña nueva',
        ];

        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',
        ], $messages);

        $current_password = Auth::User()->password;
        if(Hash::check($request->current_password, $current_password)) {
            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request->password);;
            $obj_user->save();
            return response()->json(
                [
                    'error' => false,
                    'mensaje' => 'Contraseña cambiada correctamente',
                    'code' => 200
                ],
                200);
        }else{
            return response()->json(
                [
                    'error' => true,
                    'mensaje' => 'Contraseña actual incorrecta',
                    'code' => 200
                ],
                200);
        }
   }

}
