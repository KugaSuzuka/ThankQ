<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperMessageQuestion
 */
class MessageQuestion extends Model
{
    /** @use HasFactory<\Database\Factories\MessageQuestionFactory> */
    use HasFactory;

    protected $fillable = [
        'question_text',
        'wedding_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function wedding(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }
}
