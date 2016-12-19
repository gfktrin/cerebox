<?php

namespace Cerebox\Policies;

use Cerebox\User;
use Cerebox\Contest;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the contest.
     *
     * @param  \Cerebox\User  $user
     * @param  \Cerebox\Contest  $contest
     * @return mixed
     */
    public function view(User $user, Contest $contest)
    {
        //
    }

    /**
     * Determine whether the user can create contests.
     *
     * @param  \Cerebox\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->admin;
    }

    /**
     * Determine whether the user can update the contest.
     *
     * @param  \Cerebox\User  $user
     * @param  \Cerebox\Contest  $contest
     * @return mixed
     */
    public function update(User $user, Contest $contest)
    {
        return $user->admin;
    }

    /**
     * Determine whether the user can delete the contest.
     *
     * @param  \Cerebox\User  $user
     * @param  \Cerebox\Contest  $contest
     * @return mixed
     */
    public function delete(User $user, Contest $contest)
    {
        //
    }
}
