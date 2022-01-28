<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\User;
use App\Models\Link;

class LinkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can edit the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Link  $link
     * @return mixed
     */
    public function edit(User $user, Link $link)
    {
        return $user->id === $link->id_user;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Link  $link
     * @return mixed
     */
    public function update(User $user, Link $link)
    {
        return $user->id === $link->id_user;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Link  $link
     * @return mixed
     */
    public function delete(User $user, Link $link)
    {
        return $user->id === $link->id_user;
    }

    /**
     * Determine whether the user can show the model.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Link  $link
     * @return mixed
     */
    public function show(User $user, Link $link)
    {
        return $user->id === $link->id_user;
    }
}
