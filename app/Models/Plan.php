<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Cashier;
use Mockery\Exception;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Plan extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = [
        'slug',
        'stripe_product_id',
        'name',
        'description',
        'trial_interval_count',
        'trial_interval',
        'is_active',
        'is_buyable',
        'pos',
        'type'
    ];


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    protected static function booted () {

        static::creating(function(Plan $plan) {
            $params = [
                'name' => $plan->name,
                'active' => (boolean) $plan->is_active,
            ];
            if ($plan->description)
                $params['description'] = $plan->description;

            $stripeProduct = Cashier::stripe()->products->create($params);

            $plan->stripe_product_id = $stripeProduct->id;
        });

        static::updating(function(Plan $plan) {
            $params = [
                'name' => $plan->name,
                'active' => (boolean) $plan->is_active
            ];
            if ($plan->description)
                $params['description'] = $plan->description;

            Cashier::stripe()->products->update($plan->stripe_product_id, $params);
        });

        static::deleting(function(Plan $plan) {
            if ($plan->prices->isNotEmpty())
                $plan->prices()->delete();

            Cashier::stripe()->products->update($plan->stripe_product_id, [
                'active' => false
            ]);

            if ($plan->planAccesses->isNotEmpty())
                $plan->planAccesses()->delete();
        });

    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
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



    public function prices()
    {
        return $this->hasMany(PlanPrice::class);
    }

    public function activePrices()
    {
        return $this->prices()->active();
    }

    public function chargePrice()
    {
        return $this->hasOne(PlanPrice::class);
    }

    public function activeChargePrice()
    {
        return $this->chargePrice()->whereIsActive(1);
    }

    public function planAccesses()
    {
        return $this->hasMany(PlanAccess::class);
    }


    public function getTrialUntil()
    {
        if ($this->trial_interval_count) {
            switch ($this->trial_interval) {
                case 'day':
                    return Carbon::now()->addDays($this->trial_interval_count);
                case 'week':
                    return Carbon::now()->addWeeks($this->trial_interval_count);
                case 'month':
                    return Carbon::now()->addMonths($this->trial_interval_count);
                case 'year':
                    return Carbon::now()->addYears($this->trial_interval_count);
            }
        }

        return null;
    }

}
