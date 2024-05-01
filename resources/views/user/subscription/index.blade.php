@extends('layouts.user')

@section('title', 'Subscription Management | ' . config('app.name'))

@section('styles')
@endsection

@section('content')

    <section class="tabs">
        <div>
            <div class="dashboard-mobile-start-page">
                <div class="section-dashboard-title flex flex-between">
                    <div class="title-box flex flow-column">
                        <h2 class="text-center">Subscription information</h2>
                    </div>
                </div>

                <ul class="tabs-mobile-list flex flow-column">
                    <li class="flex align-center" data-tab-mobile="tab-subscription">
                        <div class="info flex flow-column">
                            <div class="flex align-center flex-between">
                                <div class="title">Status</div>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.1714 12.0007L8.22168 7.05093L9.63589 5.63672L15.9999 12.0007L9.63589 18.3646L8.22168 16.9504L13.1714 12.0007Z"
                                        fill="black"/>
                                </svg>
                            </div>
                        </div>
                    </li>
                    <li class="flex align-center" data-tab-mobile="tab-invoices">
                        <div class="info flex flow-column">
                            <div class="flex align-center flex-between">
                                <div class="title">Invoices</div>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.1714 12.0007L8.22168 7.05093L9.63589 5.63672L15.9999 12.0007L9.63589 18.3646L8.22168 16.9504L13.1714 12.0007Z"
                                        fill="black"/>
                                </svg>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="tab-menu">
                <ul class="tab-menu-list flex">
                    <li>
                        <a href="#" class="tab-a" data-id="tab-subscription">Status</a>
                    </li>
                    <li>
                        <a href="#" class="tab-a" data-id="tab-invoices">Invoices</a>
                    </li>
                </ul>
            </div>
            <div class="wrapper-leadership">
                <div class="tab" data-id="tab-subscription">
                    <div class="btn-back-tabs flex align-center fw-medium fz-016">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.02302 10.0006L13.1478 14.1253L11.9693 15.3038L6.66602 10.0006L11.9693 4.69727L13.1478 5.87577L9.02302 10.0006Z"
                                fill="black"></path>
                        </svg>
                        Back
                    </div>
                    <div class="section-dashboard section-dashboard-profile">
                        <div class="section-dashboard-title">
                            <div class="title-box flex flow-column">
                                <h2>Subscription Status</h2>
                            </div>
                        </div>

                        <div class="section-dashboard-content flex flow-column">

                            @if(auth()->user()->isTest())

                                You are on test-access

                            @else

                            @if($subscription)
                                <h1>Your current plan:
                                    <b>{{ $subscription->plan->name . ': ' . $subscription->planPrice->title . ' $' . $subscription->planPrice->amount . '/' . $subscription->planPrice->interval }}</b>
                                </h1>
                                @if($subscription->onGracePeriod())
                                    <h2>The subscription is cancelled, the next payments will not be charged.<br>
                                        End date of the current billing period - {{ $subscription->ends_at->isoFormat('ll') }}</h2>
                                    <form action="{{ route('user.subscription.resume', $subscription) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-black" type="submit"
                                                onclick="return confirm('Are you sure?')">Resume
                                        </button>
                                    </form>
                                @else
                                    <h5>Subscribed from {{ $subscription->created_at->isoFormat('ll') }}</h5>
                                    <h5>Next billing at - {{ now()->timestamp($subscription->asStripeSubscription()->current_period_end)->isoFormat('ll') }}</h5>
                                    @php($new_amount = $subscription->hasDiscount()
                                                        ? $subscription->planPrice->amount - $subscription->discount
                                                        : $subscription->planPrice->amount)
                                    <h5>Next billing amount - ${{ $new_amount }} @if($subscription->hasDiscount()) <small>(${{ $subscription->discount }} Discount)</small> @endif</h5>
                                    <form action="{{ route('user.subscription.cancel', $subscription) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-black" type="submit"
                                                onclick="return confirm('Are you sure?')">Cancel
                                        </button>
                                    </form>
                                @endif
                            @else
                                <h1>You do not have an active subscription! Go to the <a href="{{ route('page', 'pricing') }}">subscriptions
                                        page</a> to subscribe to</h1>
                                <a class="btn btn-black"  href="{{ route('page', 'pricing') }}">Go to subscriptions page</a>
                            @endif

                            @endif

                        </div>
                    </div>
                </div>
                <div class="tab" data-id="tab-invoices">
                    <div class="btn-back-tabs flex align-center fw-medium fz-016">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.02302 10.0006L13.1478 14.1253L11.9693 15.3038L6.66602 10.0006L11.9693 4.69727L13.1478 5.87577L9.02302 10.0006Z"
                                fill="black"></path>
                        </svg>
                        Back
                    </div>

                    <div class="section-dashboard section-dashboard-profile">
                        <div class="section-dashboard-title">
                            <div class="title-box flex flow-column">
                                <h2>Last invoices</h2>
                            </div>
                        </div>
                        <div class="section-dashboard-content">
                            <div class="e-mobile-table">
                                <table class="e-table" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Plan</th>
                                            <th>Stripe NUM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->iso_created }}</td>
                                            <td>${{ $invoice->amount }}</td>
                                            <td>{{ $invoice->plan_name }}</td>
                                            <td>{{ $invoice->number }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

@endsection


