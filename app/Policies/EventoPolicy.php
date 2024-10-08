<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Evento;
use App\States\Evento\Creado;
use App\States\Evento\Finalizado;
use App\States\Evento\Iniciado;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_evento');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Evento $evento): bool
    {
        return $user->can('view_evento');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_evento');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Evento $evento): bool
    {
        if (!$evento->estado->equals(Creado::class)) {
            return false;
        }

        if (isset($evento->fecha_reprogramacion)) {
            return false;
        }
        return $user->can('update_evento');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Evento $evento): bool
    {
        if (!$evento->estado->equals(Creado::class)) {
            return false;
        }
        return $user->can('delete_evento');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_evento');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Evento $evento): bool
    {
        return $user->can('force_delete_evento');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_evento');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Evento $evento): bool
    {
        return $user->can('restore_evento');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_evento');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Evento $evento): bool
    {
        return $user->can('replicate_evento');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_evento');
    }

    /**
     * Determine whether the user can enroll students.
     */
    public function enrollStudents(User $user, Evento $evento): bool
    {
        if (!$evento->estado->equals(Creado::class)) {
            return false;
        }
        return $user->can('enroll_students_evento');
    }

    /**
     * Determine whether the user can enroll students.
     */
    public function viewOwn(User $user): bool
    {
        return $user->can('view_own_evento');
    }

    /**
     * Determine whether the user can gestionar evaluaciones.
     */
    public function gestionarEvaluaciones(User $user, Evento $evento): bool
    {
        if (!$evento->estado->equals(Finalizado::class)) {
            return false;
        }
        return $user->can('gestionar_evaluaciones_evento');
    }

    /**
     * Determine whether the user can gestionar criterios.
     */
    public function gestionarCriterios(User $user, Evento $evento): bool
    {
        if (!$evento->estado->equals(Creado::class)) {
            return false;
        }
        return $user->can('gestionar_criterios_evento');
    }
}
