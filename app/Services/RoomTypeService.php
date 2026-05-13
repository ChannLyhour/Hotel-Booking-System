<?php

namespace App\Services;

use App\Models\RoomType;

class RoomTypeService
{
    public function getAllRoomTypes(array $filters = [], int $perPage = 1)
    {
        $query = RoomType::with('hotel');

        // Search by Name or Code
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // Filter by Hotel
        if (!empty($filters['hotel_id'])) {
            $query->where('hotel_id', $filters['hotel_id']);
        }

        // Filter by Status
        if (isset($filters['is_active']) && $filters['is_active'] !== '') {
            $query->where('is_active', $filters['is_active']);
        }

        // Sorting
        $query->latest();

        return $query->paginate($perPage)->withQueryString();
    }

    public function createRoomType(array $data)
    {
        return RoomType::create($data);
    }

    public function updateRoomType(string $id, array $data)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->update($data);
        return $roomType;
    }

    public function deleteRoomType(string $id)
    {
        $roomType = RoomType::findOrFail($id);
        return $roomType->delete();
    }
}
