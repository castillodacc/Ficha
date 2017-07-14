<?php

namespace App\Policies;

use App\User;
use App\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the admin.
     *
     * @param  \App\User  $user
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function view(User $user, Admin $admin)
    {
        return($user->activo AND $user->is_admin AND $admin->gestiona_admin);
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return($user->activo AND $user->is_admin AND $user->admin->crea_admin);
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \App\User  $user
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function update(User $user, Admin $admin)
    {
        return($user->activo AND $user->is_admin AND $admin->gestiona_admin);
    }

    /**
     * Determine whether the user can edit the admin.
     *
     * @param  \App\User  $user
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function edit(User $user, Admin $admin)
    {
        return($user->activo AND $user->is_admin AND $admin->gestiona_admin);
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \App\User  $user
     * @param  \App\Admin  $admin
     * @return mixed
     */
    public function delete(User $user, Admin $admin)
    {
        return($user->activo AND $user->is_admin AND $admin->gestiona_admin);
    }

    public function crear_admin(User $user, Admin $admin)
    {
        return($user->activo AND $user->is_admin AND $admin->crea_admin);
    }

    public function gestionar_admin(User $user, Admin $admin)
    {
        return($user->activo AND $user->is_admin AND $admin->gestiona_admin);
    }

    public function crear_empleado(User $user, Admin $admin)
    {
        return($user->activo AND $user->is_admin AND $admin->crea_empleado);
    }

    public function gestionar_empleado(User $user, Admin $admin)
    {
        return($user->activo AND $user->is_admin AND $admin->gestiona_empleado);
    }

    public function crear_jornada(User $user, Admin $admin)
    {
        return($user->activo AND $user->is_admin AND $admin->crea_jornada);
    }

    public function gestionar_jornada(User $user, Admin $admin)
    {
        return($user->activo AND $user->is_admin AND $admin->gestiona_jornada);
    }

    public function crear_cliente(User $user, Admin $admin)
    {
        return($user->activo AND $user->is_admin AND $admin->crea_cliente);
    }

    public function gestionar_cliente(User $user, Admin $admin)
    {
        return($user->activo AND $user->is_admin AND $admin->gestiona_cliente);
    }

    public function generar_reporte(User $user, Admin $admin)
    {
        return($user->activo AND $user->is_admin AND $admin->genera_reporte);
    }

}
