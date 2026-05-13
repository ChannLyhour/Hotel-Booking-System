<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return $user->hasPermission('staff', 'view');
    }

    public function view(User $user, Staff $staff)
    {
        return $user->hasPermission('staff', 'view') || $user->id === $staff->user_id;
    }

    public function create(User $user)
    {
        return $user->hasPermission('staff', 'create');
    }

    public function update(User $user, Staff $staff)
    {
        return $user->hasPermission('staff', 'update');
    }

    public function delete(User $user, Staff $staff)
    {
        return $user->hasPermission('staff', 'delete');
    }
}
