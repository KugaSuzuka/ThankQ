<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperQuizChoice
 */
class QuizChoice extends Model
{
    /** @use HasFactory<\Database\Factories\QuizChoiceFactory> */
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'choice_text',
        'is_correct',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_correct' => 'boolean',
    ];

    public function quiz(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}
