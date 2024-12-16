<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Establecimiento;
use Illuminate\Auth\Access\HandlesAuthorization;

class EstablecimientoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_establecimiento');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Establecimiento $establecimiento): bool
    {
        return $user->can('view_establecimiento');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_establecimiento');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Establecimiento $establecimiento): bool
    {
        return $user->can('update_establecimiento');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Establecimiento $establecimiento): bool
    {
        return $user->can('delete_establecimiento');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_establecimiento');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Establecimiento $establecimiento): bool
    {
        return $user->can('force_delete_establecimiento');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_establecimiento');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Establecimiento $establecimiento): bool
    {
        return $user->can('restore_establecimiento');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_establecimiento');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Establecimiento $establecimiento): bool
    {
        return $user->can('replicate_establecimiento');
    }

    /**
     * Determine whether the user can verSeguimiento.
     */
    public function verSeguimiento(User $user): bool
    {
        return $user->can('ver_seguimiento_establecimiento');
    }
}
