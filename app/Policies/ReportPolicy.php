<?php

namespace App\Policies;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReportPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Issue $report): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isTimses() && ! is_null($user->timses);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Issue $report): bool
    {
        return $user->isTimses();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Issue $report): bool
    {
        return $user->isAdminOrTimses();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Issue $report): bool
    {
        return $user->isAdminOrTimses();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Issue $report): bool
    {
        return $user->isAdmin();
    }
}
