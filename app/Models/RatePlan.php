<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatePlan extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'room_type_id',
        'name',
        'code',
        'price_cents',
        'includes_breakfast',
        'is_refundable',
        'cancellation_days',
        'restrictions',
        'is_active',
    ];

    protected $casts = [
        'includes_breakfast' => 'boolean',
        'is_refundable' => 'boolean',
        'restrictions' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the room type that owns the rate plan.
     */
    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    /**
     * Get the booking rooms for the rate plan.
     */
    public function bookingRooms()
    {
        return $this->hasMany(BookingRoom::class, 'rate_plan_id');
    }
}
