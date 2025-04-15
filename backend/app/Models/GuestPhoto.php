<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin IdeHelperGuestPhoto
 */
class GuestPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'photo_path',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function guest(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    /**
     * S3の一時URLを取得する
     *
     * @return string
     */
    public function fileTemporaryUrl(): Attribute
    {
        return new Attribute(function () {
            return Storage::disk('s3')->temporaryUrl($this->photo_path, now()->addHour());
        });
    }
}
