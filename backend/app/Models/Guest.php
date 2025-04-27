<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperGuest
 */
class Guest extends Model
{
    /** @use HasFactory<\Database\Factories\GuestFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'access_token',
        'message_from_groom',
        'message_from_bride',
        'wedding_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function guestPhotos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GuestPhoto::class);
    }

    public function groom(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'wedding_id', 'wedding_id')
            ->where('role', 'groom');
    }

    public function bride(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'wedding_id', 'wedding_id')
            ->where('role', 'bride');
    }
}
