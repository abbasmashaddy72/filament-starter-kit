<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Meta extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'indexable',
        'og_image',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'indexable' => 'boolean',
    ];

    protected $with = [
        'ogImage',
    ];

    public function ogImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'og_image', 'id');
    }

    public function metaable()
    {
        return $this->morphTo();
    }
}
