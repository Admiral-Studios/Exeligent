@extends('layouts.auth')

@section('title', 'Sign Up Step 3')

@section('content')
    <input type="hidden" id="stripeKey" value="{{ $stripe_key }}">
    <input type="hidden" id="intent_secret" value="{{ $intent_secret }}">

    <section class="section login-section">
        <div class="login-section-wrapper">

            <div class="sign-up-title-box">
                <div class="sign-up-title">
                    <h1 class="login-section-title neue-bold fz-064 black">Sign Up</h1>
                    <div class="steps">
                        <span>Step 3 of 3</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
                <span class="subtitle">It will take only 2 mins to complete</span>
            </div>

            <form class="a-form__section" action="{{ route('register.checkout.store', $planPrice) }}"
                  id="subscriptionForm" method="POST">
                @csrf

                <div class="login-section-box billing">
                    <h2 class="login-section-title neue-bold fz-064 black custom-title">
                        Payment Method
                        <svg  class="powered-icon ml-auto" xmlns="http://www.w3.org/2000/svg" height="40" width="130" viewBox="-22.35 -10.25 193.7 61.5">
                            <path d="M6 0h137c3.314 0 6 2.686 6 6v29c0 3.314-2.686 6-6 6H6c-3.314 0-6-2.686-6-6V6c0-3.314 2.686-6 6-6z"
                                  fill="#32364E" fill-rule="evenodd"/>
                            <path
                                d="M71.403 26.625h-1.462l1.132-2.796-2.253-5.685h1.545l1.416 3.869 1.427-3.869h1.545zm-5.615-2.442c-.507 0-1.026-.188-1.498-.554v.413h-1.509v-8.481h1.509v2.985c.472-.354.991-.543 1.498-.543 1.581 0 2.666 1.274 2.666 3.09 0 1.816-1.085 3.09-2.666 3.09zM65.47 19.3c-.413 0-.826.177-1.18.531v2.524c.354.354.767.531 1.18.531.849 0 1.439-.731 1.439-1.793 0-1.061-.59-1.793-1.439-1.793zm-8.8 4.329c-.46.366-.979.554-1.498.554-1.569 0-2.665-1.274-2.665-3.09 0-1.816 1.096-3.09 2.665-3.09.519 0 1.038.189 1.498.543v-2.985h1.522v8.481H56.67zm0-3.798c-.342-.354-.755-.531-1.168-.531-.861 0-1.45.732-1.45 1.793 0 1.062.589 1.793 1.45 1.793.413 0 .826-.177 1.168-.531zm-8.988 1.675c.094.896.802 1.51 1.793 1.51.542 0 1.144-.201 1.757-.555v1.262c-.672.307-1.344.46-2.005.46-1.781 0-3.031-1.297-3.031-3.137 0-1.781 1.227-3.043 2.913-3.043 1.545 0 2.595 1.215 2.595 2.949 0 .165 0 .353-.024.554zm1.368-2.335c-.731 0-1.297.542-1.368 1.356h2.571c-.047-.802-.531-1.356-1.203-1.356zm-5.343.931v3.94h-1.51v-5.898h1.51v.59c.424-.472.943-.731 1.45-.731.166 0 .331.012.496.059v1.345c-.165-.048-.354-.071-.531-.071-.495 0-1.026.271-1.415.766zm-6.736 1.404c.095.896.802 1.51 1.793 1.51.543 0 1.144-.201 1.758-.555v1.262c-.673.307-1.345.46-2.006.46-1.781 0-3.031-1.297-3.031-3.137 0-1.781 1.227-3.043 2.913-3.043 1.546 0 2.595 1.215 2.595 2.949 0 .165 0 .353-.023.554zm1.368-2.335c-.731 0-1.297.542-1.368 1.356h2.572c-.048-.802-.531-1.356-1.204-1.356zm-6.641 4.871l-1.203-4.01-1.191 4.01h-1.357l-2.028-5.898h1.509l1.192 4.011 1.191-4.011h1.368l1.191 4.011 1.192-4.011h1.509l-2.017 5.898zm-9.224.141c-1.781 0-3.043-1.285-3.043-3.09 0-1.816 1.262-3.09 3.043-3.09 1.781 0 3.031 1.274 3.031 3.09 0 1.805-1.25 3.09-3.031 3.09zm0-4.918c-.885 0-1.498.743-1.498 1.828s.613 1.828 1.498 1.828c.873 0 1.486-.743 1.486-1.828s-.613-1.828-1.486-1.828zm-6.629 1.864h-1.357v2.913h-1.509v-8.115h2.866c1.651 0 2.83 1.073 2.83 2.607 0 1.533-1.179 2.595-2.83 2.595zm-.213-3.975h-1.144v2.748h1.144c.873 0 1.486-.554 1.486-1.368 0-.826-.613-1.38-1.486-1.38zm121.195 4.714h-7.25c.165 1.736 1.437 2.247 2.88 2.247 1.471 0 2.629-.309 3.639-.819v2.984c-1.007.557-2.335.96-4.106.96-3.607 0-6.135-2.259-6.135-6.726 0-3.772 2.144-6.768 5.668-6.768 3.518 0 5.354 2.995 5.354 6.788 0 .358-.033 1.134-.05 1.334zm-5.328-5.102c-.926 0-1.955.699-1.955 2.368h3.829c0-1.667-.964-2.368-1.874-2.368zM119.981 27.24c-1.296 0-2.088-.547-2.62-.937l-.008 4.191-3.703.788-.002-17.289h3.262l.192.915c.513-.479 1.45-1.162 2.902-1.162 2.601 0 5.051 2.343 5.051 6.655 0 4.707-2.424 6.839-5.074 6.839zm-.862-10.213c-.851 0-1.383.311-1.769.734l.022 5.504c.359.389.878.703 1.747.703 1.369 0 2.287-1.491 2.287-3.485 0-1.938-.932-3.456-2.287-3.456zm-10.702-3.034h3.718v12.982h-3.718zm0-4.145l3.718-.791v3.017l-3.718.79zm-3.841 8.326v8.801h-3.702V13.993h3.202l.233 1.095c.866-1.594 2.598-1.271 3.091-1.094v3.404c-.471-.152-1.949-.374-2.824.776zm-7.817 4.246c0 2.183 2.337 1.504 2.812 1.314v3.015c-.494.271-1.389.491-2.6.491-2.198 0-3.847-1.619-3.847-3.812l.016-11.883 3.616-.768.003 3.216h2.813v3.158h-2.813zm-4.494.632c0 2.666-2.122 4.188-5.202 4.188-1.277 0-2.673-.248-4.05-.841v-3.536c1.243.676 2.827 1.183 4.054 1.183.826 0 1.421-.222 1.421-.906 0-1.768-5.631-1.102-5.631-5.203 0-2.622 2.003-4.191 5.007-4.191 1.227 0 2.454.189 3.681.678v3.488c-1.127-.608-2.557-.953-3.684-.953-.776 0-1.258.224-1.258.803 0 1.666 5.662.874 5.662 5.29z"
                                fill="#FFF" fill-rule="evenodd"/>
                        </svg>
                    </h2>

                    <div id="card-element"></div>

                    <label class="a-label" for="address">Cardholder name</label>
                    <input class="a-input required @error('cardholder_name') is-invalid @enderror" id="card-holder-name"
                           type="text" name="cardholder_name" placeholder="Cardholder name *" value="{{ old('cardholder_name') }}" required>
                    <span class="invalid-feedback" role="alert" data-name="cardholder_name"></span>
                </div>

                <div class="login-section-box billing-details">
                    <h2 class="login-section-title neue-bold fz-064 black">Billing details</h2>

                    <div>
                        <label class="a-label" for="address">Billing address</label>
                        <input class="a-input required @error('address_1') is-invalid @enderror"
                               id="card-address-address-1"
                               type="text" name="address_1" placeholder="Billing address *" value="{{ old('address_1') }}" required>
                        <span class="invalid-feedback" role="alert" data-name="address_1"></span>
                    </div>

                    <div>
                        <label class="a-label" for="address">City</label>
                        <input class="a-input required @error('city') is-invalid @enderror" id="card-address-city"
                               type="text" name="city" placeholder="City *" value="{{ old('city') }}" required>
                        <span class="invalid-feedback" role="alert" data-name="city"></span>
                    </div>

                    <div>
                        <label class="a-label" for="address">State</label>
                        <input class="a-input required @error('state') is-invalid @enderror" id="card-address-state"
                               type="text" name="state" placeholder="State *" value="{{ old('state') }}" required>
                        <span class="invalid-feedback" role="alert" data-name="state"></span>
                    </div>
                </div>

                <div class="login-section-box">
                    <h2 class="login-section-title neue-bold fz-064 black">Have a voucher?</h2>

                    <input class="a-input @error('voucher_code') is-invalid @enderror" type="text" name="voucher_code"
                           placeholder="Voucher code" value="{{ old('voucher_code') }}" style="margin-bottom: 0;"
                           data-url="{{ route('auth.check-voucher') }}">
                    <span class="invalid-feedback" data-name="voucher_code" role="alert"></span>
                </div>


            <div class="login-section-box total">
                <div id="totalSummaryBlock" style="">
                    <h2 class="login-section-title neue-bold fz-064 black">Total Summary</h2>

                    <div class="separate"></div>

                    <div class="register-payment-info">
                        <div class="count">1 user x <span class="plan">{{ $planPrice->plan->name }}</span></div>
                        <div class="info">
                            <div class="price">${{ $planPrice->amount }}</div>
                        </div>
                    </div>

                    <div class="separate"></div>

                    <div class="agree-box">

                        <div class="form-group">
                            <input class="form-check @error('policy') is-invalid @enderror" type="checkbox" name="policy" id="agreeBilling" required>
                            <label for="agreeBilling">I agree to Career Company <a href="#">Fair Billing Policy</a></label>
                            @error('policy')
                            <span class="invalid-feedback" data-name="policy" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            </form>


            <div class="register-buttons step-three">
                <button class="btn btn-blue-clear" onclick='location.href = "{{ route('register.choose-plan') }}"'>Back</button>
                <button id="signUpButton" form="subscriptionForm" type="submit" class="btn btn-black fz-024 w-100">Sign Up and Confirm
                    order
                </button>
            </div>

            {{--            <div class="login-section-bottom">--}}
            {{--                By signing up, I agree to Career Company--}}
            {{--                <a href="javascript:void(0)">Terms of Service</a>--}}
            {{--                and--}}
            {{--                <a href="javascript:void(0)">Privacy Policy</a>--}}
            {{--            </div>--}}

        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/registration.js') }}"></script>
@endpush
