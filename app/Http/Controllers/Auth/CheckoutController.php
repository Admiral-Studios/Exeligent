<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register\CheckoutRequest;
use App\Models\PlanPrice;
use App\Models\Voucher;
use App\Services\SubscribeService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function index()
    {
        if (!session()->has(ChoosePlanController::PLAN_PRICE_KEY))
            return to_route('register.choose-plan');

        $stripe_key = env('STRIPE_KEY');
        $intent_secret = \Auth::user()->createSetupIntent()->client_secret;
        $planPrice = PlanPrice::find(session()->get(ChoosePlanController::PLAN_PRICE_KEY));

        return view('auth.register.checkout', compact('stripe_key', 'intent_secret', 'planPrice'));
    }

    public function store(CheckoutRequest $request, PlanPrice $planPrice)
    {
        $subscribeService = new SubscribeService();

        if ($voucher_code = session()->get('voucher_code')) {
            if (!Voucher::isValid($voucher_code)) {
                session()->remove('voucher_code');
                return back()->with('error', 'Voucher is no longer available');
            }

            $voucher = Voucher::whereCode($voucher_code)->first();

            \Auth::user()->update([
                'voucher_id' => $voucher->id,
                'voucher_expire_at' => now()->addYear()->format('Y-m-d')
            ]);
        }

        return $subscribeService->subscribe($request, $planPrice, isset($voucher_code));
    }

}
