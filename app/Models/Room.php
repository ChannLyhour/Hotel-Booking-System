<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory, HasUuid;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'string';

    protected $fillable = [
        'room_type_id',
        'number',
        'floor',
        'status',
        'features',
        'last_cleaned_at',
    ];

    protected $casts = [
        'features' => 'array',
        'last_cleaned_at' => 'datetime',
    ];

    /**
     * Get the room type that owns the room.
     */
    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    /**
     * Get the maintenance logs for the room.
     */
    public function maintenanceLogs()
    {
        return $this->hasMany(RoomMaintenance::class, 'room_id');
    }

    /**
     * Get the housekeeping tasks for the room.
     */
    public function housekeepingTasks()
    {
        return $this->hasMany(HousekeepingTask::class, 'room_id');
    }

    /**
     * Get the booking rooms for the room.
     */
    public function bookingRooms()
    {
        return $this->hasMany(BookingRoom::class, 'room_id');
    }
}
