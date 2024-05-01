<?php

namespace App\Models;

use App\Enums\PlanTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Cashier\Cashier;
use Mockery\Exception;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PlanPrice extends Model
{
    use HasFactory, HasSlug;


    const INTERVAL_YEAR = 'year';

    const ALL_INTERVALS = [
        'day',
        'week',
        'month',
        self::INTERVAL_YEAR
    ];

    protected $fillable = [
        'slug',
        'plan_id',
        'stripe_price_id',
        'title',
        'currency',
        'amount',
        'interval',
        'interval_count',
        'is_active',
        'pos'
    ];



    protected static function booted () {

        static::creating(function (PlanPrice $planPrice) {
            $is_subscription = $planPrice->plan->type == PlanTypeEnum::SUBSCRIPTION->value;

            $stripePrice = Cashier::stripe()->prices->create([
                'currency' => 'usd',
                'product' => $planPrice->plan->stripe_product_id,
                'unit_amount' => (int) round(($planPrice->amount * 100)),
                'active' => (boolean) $planPrice->is_active,
                'recurring' => $is_subscription
                    ? [
                        'interval' => $planPrice->interval,
                        'interval_count' => $planPrice->interval_count
                    ]
                    : []
            ]);

            $planPrice->stripe_price_id = $stripePrice->id;
        });

        static::updating(function (PlanPrice $planPrice) {
            Cashier::stripe()->prices->update($planPrice->stripe_price_id, [
                'active' => (boolean) $planPrice->is_active,
            ]);

            $planPrice->slug = Str::slug($planPrice->title);
        });

        static::deleting(function(PlanPrice $planPrice) {
            Cashier::stripe()->prices->update($planPrice->stripe_price_id, [
                'active' => false
            ]);
        });

    }

    public function scopeActive($query)
    {
        return $query->whereIsActive(1);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['plan.name', 'title'])
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



    public function plan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

}
