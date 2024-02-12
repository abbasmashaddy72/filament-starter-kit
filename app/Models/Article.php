<?php

namespace App\Models;

use App\Concerns\HasMeta;
use App\Concerns\Sluggable;
use App\Concerns\HasFeaturedImage;
use App\Concerns\HasPublishedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Article extends Model
{
    use HasPublishedScope, Sluggable, HasFactory, HasMeta, SoftDeletes, HasFeaturedImage, HasTranslations;

    public $translatable = ['title', 'content', 'excerpt'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'status',
        'author_id',
        'content',
        'excerpt',
        'published_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
        'content' => 'array',
    ];

    protected $with = [
        'meta',
    ];

    public function getPublicUrl()
    {
        return route('article.show', $this);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
