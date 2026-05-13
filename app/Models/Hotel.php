<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
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
        'name',
        'slug',
        'address',
        'city',
        'country',
        'currency_code',
        'timezone',
        'contact_info',
        'settings',
        'is_active',
    ];

    protected $casts = [
        'contact_info' => 'array',
        'settings' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the room types for the hotel.
     */
    public function roomTypes()
    {
        return $this->hasMany(RoomType::class, 'hotel_id');
    }

    /**
     * Get the amenities for the hotel.
     */
    public function amenities()
    {
        return $this->hasMany(HotelAmenity::class, 'hotel_id');
    }

    /**
     * Get the staff for the hotel.
     */
    public function staff()
    {
        return $this->hasMany(Staff::class, 'hotel_id');
    }

    /**
     * Get the addons for the hotel.
     */
    public function addons()
    {
        return $this->hasMany(Addon::class, 'hotel_id');
    }
}
