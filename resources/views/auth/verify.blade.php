@extends('layouts.auth')

@section('title', 'Verify Your Email')

@section('content')
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    <section class="section login-section">
        <div class="login-section-wrapper">
            <div class="login-section-box">
                <h1 class="login-section-title neue-bold fz-064 black">Verify Your Email Address</h1>

                <p>Before proceeding, please check your email for a verification link.</p>

                <br>

                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <p>If you did not receive the email -
                        <button type="submit" class="fw-semibold">{{ __('click here to request another') }}</button>
                    </p>
                </form>

            </div>
        </div>
    </section>

@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
