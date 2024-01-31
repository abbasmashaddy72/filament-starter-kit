<?php

namespace App\Models;

use Spatie\Tags\HasSlug;
use Spatie\Tags\HasTags;
use App\Concerns\HasMeta;
use Spatie\Sluggable\SlugOptions;
use App\Concerns\HasPublishedScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory, HasTags, HasPublishedScope, SoftDeletes, HasTranslations;

    public $translatable = ['question', 'answer'];
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
}
