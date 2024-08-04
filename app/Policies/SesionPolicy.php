<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Sesion;
use Illuminate\Auth\Access\HandlesAuthorization;

class SesionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_sesion');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Sesion $sesion): bool
    {
        return $user->can('view_sesion');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_sesion');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Sesion $sesion): bool
    {
        return $user->can('update_sesion');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Sesion $sesion): bool
    {
        return $user->can('delete_sesion');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_sesion');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Sesion $sesion): bool
    {
        return $user->can('force_delete_sesion');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_sesion');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Sesion $sesion): bool
    {
        return $user->can('restore_sesion');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_sesion');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Sesion $sesion): bool
    {
        return $user->can('replicate_sesion');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_sesion');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function attendance(User $user): bool
    {
        return $user->can('attendance_sesion');
    }

    /**
     * Determine whether the user can subir recursos.
     */
    public function subirRecursos(User $user): bool
    {
        return $user->can('subir_recursos_sesion');
    }
}
