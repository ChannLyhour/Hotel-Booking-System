<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoom extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'booking_id',
        'room_id',
        'rate_plan_id',
        'price_per_night_cents',
        'total_price_cents',
        'extras',
    ];

    protected $casts = [
        'extras' => 'array',
    ];

    /**
     * Get the booking that owns the booking room.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    /**
     * Get the room associated with the booking room.
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * Get the rate plan associated with the booking room.
     */
    public function ratePlan()
    {
        return $this->belongsTo(RatePlan::class, 'rate_plan_id');
    }
}
