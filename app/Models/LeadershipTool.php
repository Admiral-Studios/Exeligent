<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class LeadershipTool extends Model
{
    use HasFactory;
    use HasSlug;

    const TYPE_BOOK = 1;
    const TYPE_COURSE = 2;
    const TYPE_PODCAST = 3;
    const TYPE_CONTENT = 4;

    const ALL_TYPES = [
        self::TYPE_BOOK => 'Book Recommendations',
        self::TYPE_COURSE => 'Online Course Recommendations',
        self::TYPE_PODCAST => 'Podcast Recommendations',
        self::TYPE_CONTENT => 'Content Recommendations'
    ];


    const IMAGES_PATH = 'leadership-tools';


    protected $fillable = ['type', 'title', 'author', 'description', 'img', 'link', 'pos', 'is_active'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
