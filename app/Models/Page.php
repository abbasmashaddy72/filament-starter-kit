<?php

namespace App\Models;

use App\Concerns\HasMeta;
use App\Concerns\Sluggable;
use App\Concerns\HasFeaturedImage;
use App\Concerns\HasPublishedScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory, HasPublishedScope, Sluggable, HasMeta, SoftDeletes, HasFeaturedImage, HasTranslations;

    public $translatable = ['title', 'content'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'status',
        'content',
        'hero',
        'layout',
        'front_page',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'has_chat' => 'boolean',
        'hero' => 'array',
        'content' => 'array',
        'front_page' => 'boolean',
    ];

    protected $with = [
        'meta',
    ];

    protected static function booted()
    {
        static::creating(function ($page) {
            if (!$page->front_page) {
                return;
            }
            $oldFrontPage = Page::where('front_page', true)->first();
            if ($oldFrontPage) {
                $oldFrontPage->update([
                    'front_page' => false,
                ]);
            }

            $page->status = 'Published';
            $page->layout = 'full';
        });

        static::updating(function ($page) {
            if (!$page->front_page) {
                return;
            }
            $oldFrontPage = Page::where('front_page', true)->first();
            if ($oldFrontPage && $oldFrontPage->id !== $page->id) {
                $oldFrontPage->update([
                    'front_page' => false,
                ]);
            }

            $page->status = 'Published';
            $page->layout = 'full';
        });
    }

    public function scopeIsHomePage($query)
    {
        return $query->where('front_page', true)->first();
    }

    public function getPublicUrl()
    {
        return $this->front_page ? route('welcome') : route('pages.show', $this);
    }
}
