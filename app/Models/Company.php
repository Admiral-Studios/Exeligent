<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Company extends Model
{
    use HasSlug;

    protected $fillable = ['slug', 'name', 'description', 'link', 'is_active'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected static function booted () {

        static::deleting(function(Company $company) {
            if ($company->companyValues->isNotEmpty()) {
                $company->companyValues()->delete();
            }
        });

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

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function properties(): HasManyThrough
    {
        return $this->hasManyThrough(CompanyProperty::class, CompanyValue::class, 'company_id', 'id', 'id', 'company_property_id');
    }

    public function values(): HasManyThrough
    {
        return $this->hasManyThrough(CompanyPropertyValue::class, CompanyValue::class, 'company_id', 'id', 'id', 'company_property_value_id');
    }

    public function companyValues(): HasMany
    {
        return $this->hasMany(CompanyValue::class);
    }

    public function industry(): HasOneThrough
    {
        return $this->hasOneThrough(CompanyPropertyValue::class, CompanyValue::class, 'company_id', 'id', 'id', 'company_property_value_id')
            ->whereHas('property', function ($q) {
                return $q->whereSlug('industry');
            });
    }

    public function getPropertiesWithValues()
    {
        $result = [];
        $values = $this->values;

        foreach ($this->properties as $property) {
            $result[] = (object) [
                'property' => $property,
                'values' => $values->where('company_property_id', $property->id),
                'values_in_string' => implode(', ', $values->where('company_property_id', $property->id)->pluck('title', 'id')->toArray())
            ];
        }

        return collect($result);
    }

}
