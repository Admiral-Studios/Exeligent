@extends('layouts.auth')

@section('title', 'Sign Up Step 2')

@section('content')
    <section class="section login-section">
        <div class="login-section-wrapper">

            <div class="sign-up-title-box">
                <div class="sign-up-title">
                    <h1 class="login-section-title neue-bold fz-064 black">Sign Up</h1>
                    <div class="steps">
                        <span>Step 2 of 3</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 66.6%"></div>
                        </div>
                    </div>
                </div>
                <span class="subtitle">It will take only 2 mins to complete</span>
            </div>

            <form class="a-form__section" data-url="{{ route('register.choose-plan.store') }}"
                  id="subscriptionForm" method="POST">
                @csrf

                <div class="login-section-box subscription">
                    <h2 class="login-section-title neue-bold fz-064 black">Subscription Type</h2>

                    @error('plan_price')
                    <span class="invalid-feedback" data-name="password" role="alert" style="display:block!important;">{{ $message }}</span>
                    @enderror

                    <div class="subscription-choice">

                        @if(\App\Services\SettingService::getValueByName('free_plan') == 1)
                        <div class="subscription-choice__item">
                            <div class="period-box">
                                <div class="period">
                                    <p>
                                        <input type="radio" id="plan-test" name="plan_price" value="test" required>
                                        <label for="plan-test">FREE</label>
                                    </p>
                                </div>
                                <div class="price">Free</div>
                            </div>
                            <div class="description">
                                You will receive all the key benefits and features of our service
                            </div>
                        </div>
                        @endif

                        @foreach($plans as $plan)
                            @php($ploop = $loop)
                            @if($plan->type == \App\Enums\PlanTypeEnum::SUBSCRIPTION->value)
                                @foreach($plan->activePrices as $plan_price)
                                    <div class="subscription-choice__item">
                                        <div class="period-box">
                                            <div class="period">
                                                <p>
                                                    <input type="radio" id="plan-{{ $ploop->index . $loop->index }}"
                                                           name="plan_price" value="{{ $plan_price->id }}" @checked($selectedPlanPriceId == $plan_price->id) required>
                                                    <label
                                                        for="plan-{{ $ploop->index . $loop->index }}">{{ $plan_price->title }}</label>
                                                </p>
                                            </div>
                                            <div class="price">${{ $plan_price->amount }}</div>
                                        </div>
                                        <div class="description">{{ $plan->description }}</div>
                                    </div>
                                @endforeach
                            @else
                                @continue(!$plan->activeChargePrice)
                                <div class="subscription-choice__item">
                                    <div class="period-box">
                                        <div class="period">
                                            <p>
                                                <input type="radio" id="plan-{{ $ploop->index . $loop->index }}"
                                                       name="plan_price" value="{{ $plan->activeChargePrice->id }}" @checked($selectedPlanPriceId == $plan->activeChargePrice->id) required>
                                                <label
                                                    for="plan-{{ $ploop->index . $loop->index }}">{{ $plan->name }}</label>
                                            </p>
                                        </div>
                                        <div class="price">${{ $plan->activeChargePrice->amount }}</div>
                                    </div>
                                    <div class="description">{{ $plan->description }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </form>

            <div class="register-buttons">
                <button type="submit" form="subscriptionForm" class="btn btn-blue">Next</button>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
