<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, HasUuid, SoftDeletes;

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
        'reference',
        'guest_id',
        'user_id',
        'hotel_id',
        'check_in_date',
        'check_out_date',
        'nights',
        'status',
        'source',
        'adults',
        'children',
        'total_amount_cents',
        'paid_amount_cents',
        'currency_code',
        'special_requests',
        'metadata',
        'cancelled_by',
        'cancellation_reason',
        'cancelled_at',
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'metadata' => 'array',
        'cancelled_at' => 'datetime',
    ];

    /**
     * Get the guest that made the booking.
     */
    public function guest()
    {
        return $this->belongsTo(User::class, 'guest_id');
    }


    /**
     * Get the user that handled the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the hotel for the booking.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    /**
     * Get the rooms for the booking.
     */
    public function bookingRooms()
    {
        return $this->hasMany(BookingRoom::class, 'booking_id');
    }

    /**
     * Get the addons for the booking.
     */
    public function bookingAddons()
    {
        return $this->hasMany(BookingAddon::class, 'booking_id');
    }

    /**
     * Get the invoice for the booking.
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'booking_id');
    }

    /**
     * Get the payments for the booking.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id');
    }

    /**
     * Get the check-in record for the booking.
     */
    public function checkIn()
    {
        return $this->hasOne(CheckIn::class, 'booking_id');
    }
}
