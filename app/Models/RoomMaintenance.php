<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomMaintenance extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'room_id',
        'reported_by',
        'issue_type',
        'description',
        'status',
        'resolved_at',
        'cost_cents',
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
    ];

    /**
     * Get the room for the maintenance log.
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * Get the staff member who reported the issue.
     */
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

}
