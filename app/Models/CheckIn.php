<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'booking_id',
        'staff_id',
        'checked_in_at',
        'checked_out_at',
        'room_condition_on_arrival',
        'notes',
    ];

    protected $casts = [
        'checked_in_at' => 'datetime',
        'checked_out_at' => 'datetime',
        'room_condition_on_arrival' => 'array',
    ];

    /**
     * Get the booking associated with the check-in.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    /**
     * Get the staff member who handled the check-in.
     */
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

}
