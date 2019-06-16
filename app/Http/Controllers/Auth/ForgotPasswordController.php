<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['username' => 'required|email']);
        $user = \App\User::where('username', $request->username)->count();
        if ($user != 1) {
            return back()->with(['status' => 'El correo no se encuentra en nuestros registros.', 'color' => 'danger']);
        }

        $test = DB::table('password_resets')
        ->where('username', $request->username)
        ->where('created_at', 'BEETWEN', [\Carbon::now()->subHour(1), \Carbon::now()])
        ->count();
        if ($test) {
            return back()->with(['status' => 'Ya Hemos enviado un link a su correo para que pueda cambiar su contraseña. Por favor ingrese por ese link y cumpla con los pasos.']);
        }

        $now = \Carbon::now();
        $token = bcrypt(\Carbon::now() . '-' . uniqid() . '-' . $request->username);
        DB::table('password_resets')
        ->insert([
            'username' => $request->username,
            'token' => str_replace('/', '', $token),
            'created_at' => $now
        ]);

        $reset = DB::table('password_resets')->where('token', $token)->first();

        \Mail::to($request->username)->send(new \App\Mail\ResetPassword($reset));

        return back()->with(['status' => 'Hemos enviado un link a su correo para que pueda cambiar su contraseña. Por favor ingrese por ese link y cumpla con los pasos.']);

    }

}
