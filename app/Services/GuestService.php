<?php

namespace App\Services;

use App\Models\Guest;

class GuestService
{
    public function getAllGuests()
    {
        return Guest::all();
    }

    public function createGuest(array $data)
    {
        return Guest::create($data);
    }

    public function updateGuest(string $id, array $data)
    {
        $guest = Guest::findOrFail($id);
        $guest->update($data);
        return $guest;
    }

    public function deleteGuest(string $id)
    {
        $guest = Guest::findOrFail($id);
        return $guest->delete();
    }
}
