<section class="section section-pricing">
    <div class="wrapper-container">
        <div class="section-key-features-choice flex">
            @if(\App\Services\SettingService::getValueByName('free_plan') == 1)
                <div class="choice-box">
                    <h3 class="title-blocks neue-bold fz-040 dark">Free Plan</h3>
                    <ul class="choice-list flex">
                            <li class="choice-item">
                                <div class="monthly inter fw-bold fz-024 black">FREE</div>
                                <div class="price fw-medium neue-medium fz-048 black">$0</div>
                                <div class="description fz-018 inter black">Try it for free</div>
                                <a class="btn btn-black fz-024" href="{{ route('register') }}">Get It Now</a>
                            </li>
                    </ul>
                </div>
            @endif
            @foreach($planService->getAllActive() as $plan)
            <div class="choice-box">
                <h3 class="title-blocks neue-bold fz-040 dark">{{ $plan->name }}
                @if($plan->trial_interval_count) <span style="font-size: 1.4rem">{{ $plan->trial_interval_count . ' ' . ucfirst($plan->trial_interval) }} Free Trial</span> @endif
                </h3>
                <ul class="choice-list flex">
                    @foreach($plan->prices as $plan_price)
                    <li class="choice-item">
                        <div class="monthly inter fw-bold fz-024 black">{{ $plan_price->title }}</div>
                        <div class="price fw-medium neue-medium fz-048 black">$ {{ $plan_price->amount }}</div>
                        <div class="description fz-018 inter black">{{ $plan->description }}</div>
                        @if($plan->is_buyable)
                            @if($plan->trial_interval_count && (auth()->check() ? !auth()->user()->is_used_trial : true))
                                <a class="btn btn-black fz-024" href="{{ route('user.subscription.create', [$plan_price, 'trial']) }}">Start Free Trial</a>
                            @else
                                <a class="btn btn-black fz-024" href="{{ route('user.subscription.create', [$plan_price]) }}">Get It Now</a>
                            @endif
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</section>
