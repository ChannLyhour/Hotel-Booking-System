<?php

namespace App\Services;

use App\Models\Hotel;
use Illuminate\Support\Str;

class HotelService
{
    public function getAllHotels()
    {
        return Hotel::all();
    }

    public function createHotel(array $data)
    {
        if (!isset($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        return Hotel::create($data);
    }

    public function updateHotel(string $id, array $data)
    {
        $hotel = Hotel::findOrFail($id);
        if (isset($data['name']) && !isset($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        $hotel->update($data);
        return $hotel;
    }

    public function deleteHotel(string $id)
    {
        $hotel = Hotel::findOrFail($id);
        return $hotel->delete();
    }
}
