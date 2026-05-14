<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuestPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        // if ($user->isSuperAdmin()) {
        //     return true;
        // }
    }

    public function viewAny(User $user)
    {
        return $user->hasPermission('guests:view');
    }

    public function view(User $user, User $guest)
    {
        return $user->hasPermission('guests:view');
    }

    public function create(User $user)
    {
        return $user->hasPermission('guests:create');
    }

    public function update(User $user, User $guest)
    {
        return $user->hasPermission('guests:update');
    }

    public function delete(User $user, User $guest)
    {
        return $user->hasPermission('guests:delete');
    }
}
