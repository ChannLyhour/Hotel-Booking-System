<?php

namespace App\Services;

use App\Models\User;

class GuestService
{
    public function getAllGuests()
    {
        return User::where('user_type', 'guest')->get();
    }

    public function createGuest(array $data)
    {
        $data['user_type'] = 'guest';
        $data['name'] = ($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '');
        return User::create($data);
    }

    public function updateGuest(string $id, array $data)
    {
        $guest = User::where('user_type', 'guest')->findOrFail($id);
        if (isset($data['first_name']) || isset($data['last_name'])) {
            $data['name'] = ($data['first_name'] ?? $guest->first_name) . ' ' . ($data['last_name'] ?? $guest->last_name);
        }
        $guest->update($data);
        return $guest;
    }

    public function deleteGuest(string $id)
    {
        $guest = User::where('user_type', 'guest')->findOrFail($id);
        return $guest->delete();
    }
}
