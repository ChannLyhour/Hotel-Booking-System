<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeasonalRate extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'room_type_id',
        'name',
        'date_from',
        'date_to',
        'multiplier',
        'override_price_cents',
        'priority',
    ];

    protected $casts = [
        'date_from' => 'date',
        'date_to' => 'date',
        'multiplier' => 'decimal:2',
    ];

    /**
     * Get the room type that owns the seasonal rate.
     */
    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
