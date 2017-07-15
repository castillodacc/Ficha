<?php

namespace App\Policies;

use App\User;
use App\Empleado;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmpleadoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the empleado.
     *
     * @param  \App\User  $user
     * @param  \App\Empleado  $empleado
     * @return mixed
     */
    public function view(User $user, Empleado $empleado)
    {
        //
    }

    /**
     * Determine whether the user can create empleados.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the empleado.
     *
     * @param  \App\User  $user
     * @param  \App\Empleado  $empleado
     * @return mixed
     */
    public function update(User $user, Empleado $empleado)
    {
        //
    }

    /**
     * Determine whether the user can delete the empleado.
     *
     * @param  \App\User  $user
     * @param  \App\Empleado  $empleado
     * @return mixed
     */
    public function delete(User $user, Empleado $empleado)
    {
        //
    }

    public function iniciar_jornada(User $user, Empleado $empleado)
    {
        return($user->activo AND
               !$user->is_admin AND
               $empleado->jornadaAsignada() AND
               !$empleado->jornadaAbierta() AND
               $empleado->horaRangoIniciarJornada()
        );
    }

    public function finalizar_jornada(User $user, Empleado $empleado)
    {
        return($user->activo AND
               !$user->is_admin AND
               $empleado->jornadaAsignada() AND
               $empleado->jornadaAbierta() AND
               $empleado->horaRangoFinalizarJornada()
        );
    }

    public function horas_extras(User $user, Empleado $empleado)
    {
        return($user->activo AND
               !$user->is_admin AND
               $empleado->jornadaAsignada() AND
               $empleado->jornadaAbierta() AND
               $empleado->jornadaAdmiteHorasExtras() AND
               $empleado->horaRangoHorasExtras()
        );
    }

    public function descanso(User $user, Empleado $empleado)
    {
        return($user->activo AND
               !$user->is_admin AND
               $empleado->jornadaAsignada() AND
               $empleado->jornadaAbierta() AND
               $empleado->jornadaAdmiteTiempoDescanso()
        );
    }

    public function iniciar_descanso(User $user, Empleado $empleado)
    {
        return($user->activo AND
               !$user->is_admin AND
               $empleado->jornadaAsignada() AND
               $empleado->jornadaAbierta() AND
               $empleado->jornadaAdmiteTiempoDescanso() AND
               $empleado->horaRangoTiempoDescanso()
        );
    }

    public function finalizar_descanso(User $user, Empleado $empleado)
    {
        return($user->activo AND
               !$user->is_admin AND
               $empleado->jornadaAsignada() AND
               $empleado->jornadaAbierta() AND
               $empleado->jornadaAdmiteTiempoDescanso() AND
               $empleado->tiempoDescansoIniciado()
        );
    }

}
