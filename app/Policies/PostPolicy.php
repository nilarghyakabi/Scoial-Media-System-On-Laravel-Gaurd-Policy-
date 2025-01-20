<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Models\Admin;

use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Post $post): bool
    {
        if ($user instanceof Admin) {
            return true;
        }

        // If the user is the author of the post, they can view it
        if ($user->id === $post->user_id) {
            return true;
        }

        // If the user is following the post's author, they can view the post
        if ($user->isFollowing($post->user)) {
            return true;
        }

        // Otherwise, deny access
        return false;
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
    public function edit($user, Post $post): bool
    {
        return ($user instanceof User && $user->id === $post->user_id) || 
               ($user instanceof Admin);

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Post $post): bool
    {
        return ($user instanceof User && $user->id === $post->user_id) || 
        ($user instanceof Admin);
        }


}
