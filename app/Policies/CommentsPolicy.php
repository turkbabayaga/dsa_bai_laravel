<?php

namespace App\Policies;

use App\Models\Comments;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentsPolicy
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
    public function view(User $user, Comments $comments): bool
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
    public function update(User $user, Comments $comments): bool
    {
        // le user associé au idea peut le modifier s'il est identique au user en paramètre 
        return $comments->user()->is($user); 
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comments $comments): bool
    {
        // le user associé au idea peut le supprimer s'il est identique au user en paramètre 
        return $this->update($user, $comments); 
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Comments $comments): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Comments $comments): bool
    {
        //
    }
}
