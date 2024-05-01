<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class UserService
{


    public function getUserInvoices(User $user)
    {
        if ($user->hasStripeId()) {
            return $user->invoices()->map(function ($item) {
                $item->iso_created = Carbon::createFromTimestamp($item->created)->isoFormat('lll');
                $item->amount = $item->amount_paid / 100;
                $item->subscription_model = Subscription::where('stripe_id', $item->subscription)->first();
                $item->plan_name = $item->subscription_model ? Plan::find($item->subscription_model->name)->name : '';
                return $item;
            });
        } else {
            return new Collection();
        }
    }

}
