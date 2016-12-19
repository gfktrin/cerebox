<?php

namespace Cerebox\Policies;

use Cerebox\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function create(User $user){
        $valid = $user->admin;

        return $valid;
    }
}
