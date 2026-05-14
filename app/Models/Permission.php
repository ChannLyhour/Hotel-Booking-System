<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
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
        'role_id',
        'resource',
        'action',
        'conditions',
    ];

    protected $casts = [
        'conditions' => 'array',
    ];

    /**
     * Get the role that owns the permission.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
