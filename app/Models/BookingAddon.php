<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAddon extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'booking_id',
        'addon_id',
        'quantity',
        'unit_price_cents',
        'total_price_cents',
        'service_date',
    ];

    protected $casts = [
        'service_date' => 'date',
    ];

    /**
     * Get the booking that owns the booking addon.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    /**
     * Get the addon associated with the booking addon.
     */
    public function addon()
    {
        return $this->belongsTo(Addon::class, 'addon_id');
    }
}
