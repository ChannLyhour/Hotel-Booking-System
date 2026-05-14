<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
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
        'name',
        'code',
        'max_occupancy',
        'base_price_cents',
        'bed_type',
        'amenities',
        'description',
        'images',
        'is_active',
    ];

    protected $casts = [
        'amenities' => 'array',
        'images' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the hotel that owns the room type.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    /**
     * Get the rooms for the room type.
     */
    public function rooms()
    {
        return $this->hasMany(Room::class, 'room_type_id');
    }

    /**
     * Get the rate plans for the room type.
     */
    public function ratePlans()
    {
        return $this->hasMany(RatePlan::class, 'room_type_id');
    }

    /**
     * Get the seasonal rates for the room type.
     */
    public function seasonalRates()
    {
        return $this->hasMany(SeasonalRate::class, 'room_type_id');
    }
}
