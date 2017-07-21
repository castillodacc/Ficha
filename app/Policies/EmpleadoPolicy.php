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

    public function usuario_activo(User $user)
    {
        return($user->activo);
    }

    public function usuario_no_admin(User $user)
    {
        return(!$user->is_admin);
    }

    public function jornada_asignada(User $user, Empleado $empleado)
    {
        return($empleado->jornadaAsignada());
    }

    public function jornada_abierta(User $user, Empleado $empleado)
    {
        return($empleado->jornadaAbierta());
    }

    public function jornada_cerrada(User $user, Empleado $empleado)
    {
        return(!$empleado->jornadaAbierta());
    }

    public function jornada_admite_horas_extras(User $user, Empleado $empleado)
    {
        return($empleado->jornadaAdmiteHorasExtras());
    }

    public function jornada_admite_tiempo_descanso(User $user, Empleado $empleado)
    {
        return($empleado->jornadaAdmiteTiempoDescanso());
    }

    public function tiempo_descanso_iniciado(User $user, Empleado $empleado)
    {
        return($empleado->tiempoDescansoIniciado());
    }

    public function tiempo_descanso_finalizado(User $user, Empleado $empleado)
    {
        return($empleado->tiempoDescansoFinalizado());
    }

    public function hora_rango_iniciar_jornada(User $user, Empleado $empleado)
    {
        return($empleado->horaRangoIniciarJornada());
    }

    public function hora_rango_finalizar_jornada(User $user, Empleado $empleado)
    {
        return($empleado->horaRangoFinalizarJornada());
    }

    public function hora_rango_horas_extras(User $user, Empleado $empleado)
    {
        return($empleado->horaRangoHorasExtras());
    }

    public function horas_extras_iniciadas(User $user, Empleado $empleado)
    {
        return($empleado->horasExtrasIniciadas());
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
               $empleado->jornadaAdmiteTiempoDescanso()
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
