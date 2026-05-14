<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HousekeepingTask extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'room_id',
        'assigned_to',
        'task_type',
        'priority',
        'status',
        'scheduled_at',
        'completed_at',
        'notes',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the room for the housekeeping task.
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * Get the staff member assigned to the task.
     */
    public function staff()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

}
