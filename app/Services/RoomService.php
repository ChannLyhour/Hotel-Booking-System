<?php

namespace App\Services;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Support\Facades\DB;
use Exception;

class RoomService
{
    /**
     * Get all rooms grouped by type.
     */
    public function getAllRoomsGroupedByType()
    {
        return RoomType::with('rooms')->get();
    }

    /**
     * Create a new room.
     */
    public function createRoom(array $data)
    {
        return Room::create($data);
    }

    /**
     * Update an existing room.
     */
    public function updateRoom(string $id, array $data)
    {
        $room = Room::findOrFail($id);
        $room->update($data);
        return $room;
    }

    /**
     * Delete a room.
     */
    public function deleteRoom(string $id)
    {
        $room = Room::findOrFail($id);
        return $room->delete();
    }

    /**
     * Change room status.
     */
    public function updateRoomStatus(string $id, string $status)
    {
        $room = Room::findOrFail($id);
        $room->status = $status;
        $room->save();
        return $room;
    }
}
