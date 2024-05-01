<?php

namespace App\Services;

use App\Enums\PlanTypeEnum;
use App\Models\PlanPrice;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeService
{

    public function subscribe(Request $request, mixed $planPrice, bool $voucher_activated = false)
    {
        $user = Auth::user();
        if (!$user && $request->has('email')) {
            $user = User::whereEmail($request->post('email'));
        }
        $isNewUser = \Str::contains(url()->previous(), 'register/checkout') && $user->created_at->isToday();

        if ($planPrice === 'test')
            return $this->handleTestSubscription($request, $isNewUser);

        if (!$voucher_activated) {
            $request->validate([
                'cardholder_name' => ['required', 'string'],
                'state' => ['required', 'string'],
                'city' => ['required', 'string'],
                'address_1' => ['required', 'string']
            ]);
        }

        if (!($planPrice instanceof PlanPrice))
            $planPrice = PlanPrice::whereId($planPrice)->orWhere('slug', $planPrice)->firstOrFail();

        $plan = $planPrice->plan;
        if (!($plan->is_active && $plan->is_buyable) || !$planPrice->is_active)
            return back()->with('error', 'The plan is no available');


        try {
            if ($voucher_activated)
                return $this->handleTestSubscription($request, $isNewUser);

            $user->createOrGetStripeCustomer(['name' => $user->full_name]);

            $stripePaymentMethodId = $request->post('payment_method_id');
            if (!$stripePaymentMethodId) {
                $stripePaymentMethod = $user->addPaymentMethod($request->post('token'));

                $address = $stripePaymentMethod->billing_details->address->postal_code . ' '
                    . $stripePaymentMethod->billing_details->address->line1 . ', '
                    . $stripePaymentMethod->billing_details->address->city . ', '
                    . $stripePaymentMethod->billing_details->address->state;

                $stripePaymentMethodId = $stripePaymentMethod->id ?? null;

                if (!$stripePaymentMethodId)
                    throw new Exception('An error occurred while trying to generate a payment. Please try again');
            }

            if ($plan->type == PlanTypeEnum::SUBSCRIPTION->value) {
                return $this->handleSubscription($request, $user, $plan, $planPrice, $stripePaymentMethodId, $stripePaymentMethod, $address, $isNewUser);
            } elseif ($plan->type == PlanTypeEnum::ONE_TIME_CHARGE->value) {
                return $this->handleOneTimeCharge($request, $user, $plan, $planPrice, $stripePaymentMethodId, $isNewUser);
            }
        } catch (Exception $exception) {
            if ($request->ajax()) {
                return new JsonResponse([
                    'status' => 'error',
                    'message' => $exception->getMessage()
                ], 500);
            }

            return back()
                ->with('error', 'ERROR: ' . $exception->getMessage());
        }
    }

    public function handleTestSubscription(Request $request, bool $isNewUser)
    {
        Auth::user()->update(['role_id' => User::ROLE_TEST]);

        if ($request->wantsJson()) {
            \Session::flash('success', 'Subscription successful!');
            return [
                'redirect_url' => $isNewUser
                    ? route('user.registration-confirmation.index')
                    : route('user.profile')
            ];
        }

        if ($isNewUser)
            return to_route('user.registration-confirmation.index');

        return to_route('user.profile')->with('success', 'Subscription successful!');
    }

    private function handleSubscription($request, $user, $plan, $planPrice, $stripePaymentMethodId, $stripePaymentMethod, $address, $isNewUser)
    {
        $newSubscription = $user->newSubscription($plan->id, $planPrice->stripe_price_id);

        if ($request->has('trial'))
            $newSubscription->trialUntil($plan->getTrialUntil());

        $newSubscription->create($stripePaymentMethodId);

        $user->update([
            'role_id' => User::ROLE_USER,
            'pm_cardholder_name' => $stripePaymentMethod->billing_details->name,
            'pm_billing_address' => $address
        ]);

        $log = "Subscribed to plan - {$plan->name}";
        if ($request->has('trial')) {
            $user->update(['is_used_trial' => true]);
            $log = "Started free trial for plan - {$plan->name}";
        }

        activity('subscription')
            ->log($log);

        if (!Auth::check())
            Auth::login($user);

        if ($request->ajax()) {
            \Session::flash('success', 'Subscription successful!');
            return [
                'redirect_url' => $isNewUser
                    ? route('user.registration-confirmation.index')
                    : route('user.profile')
            ];
        }

        if ($isNewUser)
            return redirect()->route('user.registration-confirmation.index');

        return redirect()->route('user.profile')->with('success', 'Subscription successful!');
    }

    private function handleOneTimeCharge($request, $user, $plan, $planPrice, $stripePaymentMethodId, $isNewUser)
    {
        $charge = $user->charge(($planPrice->amount * 100), $stripePaymentMethodId);

        $user->update([
            'role_id' => User::ROLE_USER,
            'plan_id' => $plan->id,
            'stripe_payment_intent_id' => $charge->asStripePaymentIntent()->id
        ]);

        activity('subscription')
            ->log("Bought plan - {$plan->name}");

        if (!Auth::check())
            Auth::login($user);

        if ($request->wantsJson()) {
            \Session::flash('success', 'Subscription successful!');
            return [
                'redirect_url' => $isNewUser
                    ? route('user.registration-confirmation.index')
                    : route('user.profile')
            ];
        }

        if ($isNewUser)
            return redirect()->route('user.registration-confirmation.index');

        return redirect()->route('user.profile')->with('success', 'Subscription successful!');
    }

}
