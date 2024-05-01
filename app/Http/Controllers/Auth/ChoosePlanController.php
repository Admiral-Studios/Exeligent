<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register\ChoosePlanRequest;
use App\Services\PlanService;
use App\Services\SubscribeService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChoosePlanController extends Controller
{

    const PLAN_PRICE_KEY = 'plan_price';

    public function index()
    {
        $plans = (new PlanService())->getAllActive();
        $selectedPlanPriceId = session()->has(self::PLAN_PRICE_KEY) ? session()->get(self::PLAN_PRICE_KEY) : null;

        return view('auth.register.choose-plan', compact('plans', 'selectedPlanPriceId'));
    }

    public function store(ChoosePlanRequest $request)
    {
        $subscribeService = new SubscribeService();
        $planPriceId = $request->post('plan_price');

        if ($planPriceId === 'test')
            return $subscribeService->handleTestSubscription($request, true);

        session()->put(self::PLAN_PRICE_KEY, $planPriceId);

        return to_route('register.checkout');
    }

}
