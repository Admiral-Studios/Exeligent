@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

    <section class="section login-section">
        <div class="login-section-wrapper">
            <div class="login-section-box">
                <h1 class="login-section-title neue-bold fz-064 black">Reset Password</h1>
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <label class="a-label" for="email">Email Address</label>
                    <input class="a-input @error('email') is-invalid @enderror" name="email" type="email" id="email" placeholder="Work Email *" value="{{ old('email') }}" autocomplete="email" autofocus required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="login-section-buttons flex align-center">
                        <button type="submit" class="btn btn-black fz-024 send-reset-btn">Send Password Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection

