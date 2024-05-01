<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CompanyPropertyValue extends Model
{
    use HasSlug;

    protected $fillable = ['company_property_id', 'slug', 'title', 'is_active', 'pos'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


    public function property(): BelongsTo
    {
        return $this->belongsTo(CompanyProperty::class, 'company_property_id', 'id');
    }

}
