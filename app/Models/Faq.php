<?php

namespace App\Models;

use Spatie\Tags\HasSlug;
use Spatie\Tags\HasTags;
use App\Concerns\HasMeta;
use Spatie\Sluggable\SlugOptions;
use App\Concerns\HasPublishedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory, HasTags, HasPublishedScope, HasMeta, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'status',
        'answer',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    protected $with = [
        'meta',
    ];
}
