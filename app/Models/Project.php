<?php

namespace App\Models;

use App\Concerns\HasMeta;
use Awcodes\Curator\Models\Media;
use App\Concerns\HasFeaturedImage;
use App\Concerns\HasPublishedScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasPublishedScope, HasFactory, HasMeta, SoftDeletes, HasFeaturedImage, HasTranslations;

    public $translatable = ['title', 'excerpt'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image_id',
        'title',
        'location',
        'excerpt',
        'status',
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id', 'id');
    }
}
