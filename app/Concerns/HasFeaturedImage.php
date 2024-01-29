<?php

namespace App\Concerns;

trait HasFeaturedImage
{
    protected $defaultFeaturedImage = [
        'url' => '',
        'thumbnail_url' => '',
        'medium_url' => '',
        'large_url' => '',
        'alt' => '',
        'width' => '',
        'height' => '',
    ];

    public function getFeaturedImageAttribute()
    {
        return $this->meta && $this->meta->ogImage ? $this->meta->ogImage : (object) $this->defaultFeaturedImage;
    }
}
