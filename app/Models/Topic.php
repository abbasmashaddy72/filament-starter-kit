<?php

namespace App\Models;

use App\Concerns\HasMeta;
use App\Concerns\Sluggable;
use App\Concerns\HasFeaturedImage;
use App\Concerns\HasPublishedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasPublishedScope, Sluggable, HasFactory, HasMeta, SoftDeletes, HasFeaturedImage;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'status',
        'excerpt',
        'content',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'indexable' => 'boolean',
        'content' => 'array',
    ];

    protected $with = [
        'meta',
    ];

    public function getPublicUrl()
    {
        return route('topics.show', $this);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
