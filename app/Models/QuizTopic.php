<?php

namespace App\Models;

use App\Concerns\HasMeta;
use App\Concerns\Sluggable;
use Awcodes\Curator\Models\Media;
use App\Concerns\HasFeaturedImage;
use App\Concerns\HasPublishedScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class QuizTopic extends Model
{
    use HasFactory, SoftDeletes, Sluggable, HasMeta, HasTranslations, HasPublishedScope, HasFeaturedImage;

    public $translatable = ['title', 'content', 'excerpt'];

    protected $fillable = [
        'type',
        'title',
        'start',
        'end',
        'is_age_restricted',
        'total_question_count',
        'content',
        'hero',
        'excerpt',
        'slug',
        'status',
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
        'is_age_restricted' => 'boolean',
        'content' => 'array',
        'hero' => 'array',
        'title' => 'array',
        'excerpt' => 'array',
    ];

    protected $with = [
        'meta',
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
