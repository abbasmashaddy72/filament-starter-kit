<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use App\Concerns\HasMeta;
use App\Concerns\Sluggable;
use Illuminate\Support\Str;
use App\Concerns\HasFeaturedImage;
use App\Concerns\HasPublishedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasPublishedScope, Sluggable, HasFactory, HasTags, HasMeta, SoftDeletes, HasFeaturedImage;

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
        'published_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'indexable' => 'boolean',
        'published_at' => 'date',
        'content' => 'array',
    ];

    protected $appends = [
        'excerpt',
    ];

    protected $with = [
        'meta',
    ];

    public function getExcerptAttribute(): string
    {
        return Str::of(strip_tags($this->content[0]['blocks'][0]['data']['content']))->excerpt(null, ['radius' => 300]);
    }

    public function getPublicUrl()
    {
        return route('blog.show', $this);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
