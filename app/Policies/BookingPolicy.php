<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
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
        return $user->hasPermission('bookings', 'view');
    }

    public function view(User $user, Booking $booking)
    {
        return $user->hasPermission('bookings', 'view');
    }

    public function create(User $user)
    {
        return $user->hasPermission('bookings', 'create');
    }

    public function update(User $user, Booking $booking)
    {
        return $user->hasPermission('bookings', 'update');
    }

    public function delete(User $user, Booking $booking)
    {
        return $user->hasPermission('bookings', 'delete');
    }

    public function cancel(User $user, Booking $booking)
    {
        return $user->hasPermission('bookings', 'cancel');
    }
}
