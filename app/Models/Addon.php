<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'hotel_id',
        'name',
        'category',
        'unit_price_cents',
        'is_per_night',
        'is_active',
    ];

    protected $casts = [
        'is_per_night' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the hotel that owns the addon.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    /**
     * Get the booking addons for the addon.
     */
    public function bookingAddons()
    {
        return $this->hasMany(BookingAddon::class, 'addon_id');
    }
}
