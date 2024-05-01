<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CompanyProperty extends Model
{
    use HasSlug;

    protected $fillable = ['slug', 'title', 'is_active', 'pos'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


    public function scopeActive()
    {
        return $this->where('is_active', 1);
    }

    public function values(): HasMany
    {
        return $this->hasMany(CompanyPropertyValue::class);
    }

}
