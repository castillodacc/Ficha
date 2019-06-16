<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());
        $test = DB::table('password_resets')
        ->where('username', $request->email)
        ->where('token', $request->token)
        ->where('created_at', 'BEETWEN', [\Carbon::now()->subHour(1), \Carbon::now()])
        ->count();
        if ($test) {
            $user = \App\User::where('username', $request->email)->first();
            $user->update(['password' => bcrypt($request->password)]);
            if ($user) {
                return redirect('/')->with(['status' => 'Cambio de contraseña exitoso...']);
            }
        }
        return back()->with(['status' => 'Hubo un error al cambiar datos, Por favor vuelva a intentarlo.']);
    }
}
