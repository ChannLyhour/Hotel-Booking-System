<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestDocument extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'guest_id',
        'document_type',
        'file_path',
        'file_hash',
        'expires_at',
        'uploaded_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'uploaded_at' => 'datetime',
    ];

    /**
     * Get the guest that owns the document.
     */
    public function guest()
    {
        return $this->belongsTo(User::class, 'guest_id');
    }

}
