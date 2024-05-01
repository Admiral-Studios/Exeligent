@extends("layouts.front")

@section('title', 'Get Subscription')

@section('content')

    <input type="hidden" id="stripeKey" value="{{ $stripe_key }}">


    <section class="section section-payment">
        <div class="wrapper-container">
            <h2 class="title-section">You are buying subscription: <b>{{ $plan->name . ' - ' . $planPrice->title }}</b></h2>
            <div class="description">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                     width="18" height="18" viewBox="0 0 256 256" xml:space="preserve">

<defs>
</defs>
                    <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                       transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                        <polygon points="37.95,64.44 23.78,50.27 30.85,43.2 37.95,50.3 59.15,29.1 66.22,36.17 "
                                 style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,158,4); fill-rule: nonzero; opacity: 1;"
                                 transform="  matrix(1 0 0 1 0 0) "/>
                        <path
                            d="M 45 90 C 20.187 90 0 69.813 0 45 C 0 20.187 20.187 0 45 0 c 24.813 0 45 20.187 45 45 C 90 69.813 69.813 90 45 90 z M 45 10 c -19.299 0 -35 15.701 -35 35 s 15.701 35 35 35 s 35 -15.701 35 -35 S 64.299 10 45 10 z"
                            style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,158,4); fill-rule: nonzero; opacity: 1;"
                            transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round"/>
                    </g>
</svg>
                Your payment information is save with us
            </div>

            <form class="a-form__section" action="{{ route('user.subscription.store', $planPrice) }}"
                  id="subscriptionForm"
                  method="POST">
                @csrf

                @if($plan->trial_interval_count && !auth()->user()->is_used_trial)
                    <label>Start Free Trial for <b>{{ $plan->trial_interval_count . ' ' . $plan->trial_interval }}</b>
                        <input type="checkbox" name="trial" @checked(request()->type == 'trial')>
                    </label>
                @endif

                @includeWhen(auth()->check(), 'user.subscription._payment-methods',
                        ['user' => auth()->user(), 'user_payment_methods' => $user_payment_methods, 'user_default_payment_method' => $user_default_payment_method])

                <button class="btn btn-black" id="card-button" data-secret="{{ $intent->client_secret }}">
                    Submit Payment
                </button>
            </form>
        </div>

    </section>

@endsection

@push('scripts')
    <script src="{{ asset('/js/jquery-3.7.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-country-selector@2.0.1/src/js/jquery.countrySelector.min.js"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/subscription.js') }}"></script>
    <script src="{{ asset('js/search-city.js') }}"></script>
@endpush
