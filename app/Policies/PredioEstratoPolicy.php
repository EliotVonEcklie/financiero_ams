<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\PredioEstrato;
use App\Models\User;

class PredioEstratoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PredioEstrato $predio_estrato): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PredioEstrato $predio_estrato): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PredioEstrato $predio_estrato): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PredioEstrato $predio_estrato): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PredioEstrato $predio_estrato): bool
    {
        //
    }
}
