<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
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
        'hotel_id',
        'user_id',
        'department',
        'position',
        'work_schedule',
        'is_active',
    ];

    protected $casts = [
        'work_schedule' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the hotel where the staff member works.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    /**
     * Get the user account for the staff member.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the check-ins handled by the staff member.
     */
    public function checkIns()
    {
        return $this->hasMany(CheckIn::class, 'staff_id');
    }

    /**
     * Get the housekeeping tasks assigned to the staff member.
     */
    public function housekeepingTasks()
    {
        return $this->hasMany(HousekeepingTask::class, 'assigned_to');
    }

    /**
     * Get the room maintenance logs reported/handled by the staff member.
     */
    public function maintenanceLogs()
    {
        return $this->hasMany(RoomMaintenance::class, 'reported_by');
    }
}
