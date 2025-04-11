<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageAnswer extends Model
{
    /** @use HasFactory<\Database\Factories\MessageAnswerFactory> */
    use HasFactory;
    protected $fillable = [
        'guest_id',
        'message_question_id',
        'answer',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
    public function messageQuestion(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MessageQuestion::class);
    }
}
