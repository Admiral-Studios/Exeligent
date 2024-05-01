<?php

namespace App\Listeners;

use App\Models\Subscription;
use Laravel\Cashier\Events\WebhookReceived;

class InvoicePaidEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] === 'invoice.paid') {
            $invoice = $event->payload['data']['object'];
            $subscription_stripe_id = $invoice['subscription'] ?? null;

            if ($subscription_stripe_id) {
                $subscription = Subscription::where('stripe_id', $subscription_stripe_id)->first();
                if ($subscription)
                    $subscription->update(['discount' => null]);
            }

        }
    }
}
