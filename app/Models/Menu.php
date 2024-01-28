<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title', 'items'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "key",
        "location",
        "title",
        "items",
        "activated",
    ];

    protected $casts = [
        "items" => "array"
    ];
}
