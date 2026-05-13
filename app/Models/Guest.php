<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
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
        'first_name',
        'last_name',
        'email',
        'phone',
        'nationality',
        'id_document_type',
        'id_document_no',
        'vip_tier',
        'loyalty_points',
        'preferences',
    ];

    protected $casts = [
        'preferences' => 'array',
    ];

    /**
     * Get the bookings for the guest.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'guest_id');
    }

    /**
     * Get the documents for the guest.
     */
    public function documents()
    {
        return $this->hasMany(GuestDocument::class, 'guest_id');
    }
}
