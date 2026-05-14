<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\HasUuid;
use App\Traits\HasPermissions;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasUuid, SoftDeletes, HasPermissions;

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

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'name',
        'email',
        'phone',
        'password',
        'role_id',
        'user_type',
        'is_active',
        'nationality',
        'id_document_type',
        'id_document_no',
        'vip_tier',
        'loyalty_points',
        'preferences',
        'hotel_id',
        'department',
        'position',
        'work_schedule',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'preferences' => 'array',
            'work_schedule' => 'array',
        ];
    }

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Get the hotel associated with the staff member.
     */
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    /**
     * Get bookings associated with the guest.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'guest_id');
    }

    /**
     * Get documents associated with the guest.
     */
    public function documents()
    {
        return $this->hasMany(GuestDocument::class, 'guest_id');
    }
}

