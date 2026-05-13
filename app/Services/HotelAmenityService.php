<?php

namespace App\Services;

use App\Models\HotelAmenity;

class HotelAmenityService
{
    public function getAllAmenities()
    {
        return HotelAmenity::with('hotel')->get();
    }

    public function createAmenity(array $data)
    {
        return HotelAmenity::create($data);
    }

    public function updateAmenity(string $id, array $data)
    {
        $amenity = HotelAmenity::findOrFail($id);
        $amenity->update($data);
        return $amenity;
    }

    public function deleteAmenity(string $id)
    {
        $amenity = HotelAmenity::findOrFail($id);
        return $amenity->delete();
    }
}
