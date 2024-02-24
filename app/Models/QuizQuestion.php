<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizQuestion extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['question_text', 'answer_explanation'];

    protected $fillable = [
        'quiz_topic_id',
        'question_text',
        'answer_explanation',
        'more_info_link',
        'age_restriction_condition',
    ];

    protected $casts = [
        'question_text' => 'array',
        'answer_explanation' => 'array',
    ];

    public function quizTopic(): BelongsTo
    {
        return $this->belongsTo(QuizTopic::class);
    }

    public function quizOptions(): HasMany
    {
        return $this->hasMany(QuizOption::class);
    }
}
