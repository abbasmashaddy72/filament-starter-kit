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
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
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
        'icon',
        'image_id',
        'status',
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
        'published_at' => 'datetime:Y-m-d',
        'content' => 'array',
    ];

    protected $with = [
        'meta',
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id', 'id');
    }
}
