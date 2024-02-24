<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizTopic extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = [
        'type',
        'title',
        'start',
        'end',
        'is_age_restricted',
        'total_question_count',
        'description',
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'is_age_restricted' => 'boolean',
        'description' => 'array',
        'title' => 'array',
    ];

    public function medias(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'quiz_topic_media', 'quiz_topic_id', 'media_id')
            ->withPivot('order')
            ->orderBy('order');
    }

    public function quizQuestions(): HasMany
    {
        return $this->hasMany(QuizQuestion::class);
    }
}
