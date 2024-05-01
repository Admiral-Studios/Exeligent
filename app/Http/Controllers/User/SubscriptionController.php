<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PlanPrice;
use App\Models\Subscription;
use App\Models\User;
use App\Services\SubscribeService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SubscriptionController extends Controller
{

    public function __construct(private UserService $userService)
    {
    }

    public function index()
    {
        $subscription = Auth::user()->activeSubscription;
        $invoices = $this->userService->getUserInvoices(Auth::user());
        return view('user.subscription.index', compact('subscription', 'invoices'));
    }

    public function create(PlanPrice $planPrice, $type = null)
    {
        if (Auth::user()->isTest())
            return to_route('user.subscriptions.index')->with('error', 'You are on test-access');

        $plan = $planPrice->plan;
        $intent = Auth::user()->createSetupIntent();
        $stripe_key = env('STRIPE_KEY');

        $user_payment_methods = Auth::user()->paymentMethods();
        $user_default_payment_method = Auth::user()->defaultPaymentMethod();

        return view('subscription.index', compact('plan', 'planPrice',
            'intent', 'stripe_key', 'user_payment_methods', 'user_default_payment_method'));
    }

    public function store(Request $request, $planPrice)
    {
        return (new SubscribeService())->subscribe($request, $planPrice);
    }

    public function change(Request $request, Subscription $subscription)
    {
        $new_price = $request->post('price');

        if ($subscription->hasPrice($new_price))
            return back()->with('error', 'Plan is already using');

        try {
            $subscription->swap($new_price);
            return back()->with('success', 'Subscription plan changed');
        } catch (Exception $exception) {
            return back()->with('error', 'ERROR: '. $exception->getMessage());
        }
    }

    public function cancel(Request $request, Subscription $subscription)
    {
        if (Hash::check($request->post('password'), Auth::user()->password)) {
            $subscription->cancel();
            return back()->with('success', 'Your subscription is cancelled');
        }

        return back()->with('error', 'Failed to cancel subscription!');
    }

    public function resume(Request $request, Subscription $subscription)
    {
        $subscription->resume();
        return back()->with('success', 'Your subscription is resumed');
    }


}
