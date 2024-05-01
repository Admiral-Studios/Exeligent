<?php

namespace App\Models;

use Laravel\Cashier\Subscription as StripeSubscription;

class Subscription extends StripeSubscription
{

    protected $fillable = [
        'name',
        'stripe_id',
        'stripe_status',
        'stripe_price',
        'quantity',
        'trial_ends_at',
        'ends_at',
        'discount'
    ];



    /** \/ System \/ */
    public function applyDiscount($coupon, $amount): void
    {
        $this->update(['discount' => $amount]);
        $this->applyCoupon($coupon);
    }
    /** /\ End System /\ */


    /** \/ Custom \/ */
    public function hasDiscount()
    {
        return $this->discount !== null;
    }
    /** /\ End Custom /\ */


    /** \/ Relations \/ */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'name');
    }


    public function planPrice()
    {
        return $this->belongsTo(PlanPrice::class, 'stripe_price', 'stripe_price_id');
    }
    /** /\ End Relations /\ */


}
