<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before($user, $ability)
    {
        return $user->admin ? true : null;
    }

    public function confirmation(User $user, User $model)
    {
        return $user->id == $model->id;
    }

    public function admin(User $user)
    {
        return $user->admin;
    }
}
