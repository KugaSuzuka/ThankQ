<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperQuizAnswer
 */
class QuizAnswer extends Model
{
    /** @use HasFactory<\Database\Factories\QuizAnswerFactory> */
    use HasFactory;

    protected $fillable = [
        'quiz_choice_id',
        'guest_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function guest(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function quizChoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(QuizChoice::class);
    }
}
