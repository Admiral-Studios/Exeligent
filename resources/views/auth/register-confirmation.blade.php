@extends('layouts.auth')

@section('title', 'Registration Confirmation')

@section('content')

    <input type="hidden" id="stripeKey">
    <section class="section login-section">
        <div class="login-section-wrapper">

            <div class="login-section-box confirmation">
                <svg width="69" height="72" viewBox="0 0 69 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M32.1434 4.38555C33.548 3.361 35.4535 3.361 36.858 4.38555L42.1994 8.28185C42.886 8.78273 43.7144 9.05188 44.5643 9.05026L51.1757 9.03767C52.9142 9.03436 54.4558 10.1544 54.9899 11.8088L57.021 18.1007C57.2821 18.9095 57.7941 19.6141 58.4826 20.1124L63.8387 23.9883C65.2472 25.0075 65.836 26.8197 65.2956 28.4721L63.2406 34.7561C62.9765 35.5639 62.9765 36.4348 63.2406 37.2426L65.2956 43.5266C65.836 45.179 65.2472 46.9912 63.8387 48.0104L58.4826 51.8863C57.7941 52.3846 57.2821 53.0892 57.021 53.898L54.9899 60.1898C54.4558 61.8443 52.9143 62.9643 51.1758 62.961L44.5643 62.9485C43.7144 62.9469 42.8861 63.216 42.1994 63.7169L36.858 67.6132C35.4535 68.6377 33.548 68.6377 32.1434 67.6132L26.802 63.7169C26.1154 63.216 25.287 62.9469 24.4372 62.9485L17.8257 62.961C16.0872 62.9643 14.5456 61.8443 14.0115 60.1898L11.9804 53.898C11.7193 53.0892 11.2074 52.3846 10.5188 51.8863L5.16266 48.0104C3.75423 46.9912 3.16539 45.179 3.70577 43.5266L5.76078 37.2427C6.02496 36.4348 6.02496 35.5639 5.76078 34.756L3.70577 28.4721C3.16539 26.8197 3.75422 25.0075 5.16266 23.9883L10.5188 20.1124C11.2074 19.6141 11.7193 18.9095 11.9804 18.1007L14.0115 11.8088C14.5456 10.1544 16.0872 9.03436 17.8257 9.03767L24.4371 9.05026C25.287 9.05188 26.1154 8.78273 26.802 8.28185L32.1434 4.38555Z" fill="#B3D9FF" stroke="#027FFE" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21.0176 35.3404L31.6243 45.9472L48.5831 28.9884L44.2985 24.7637L31.5944 37.4678L25.2423 31.1157L21.0176 35.3404Z" fill="#027FFE"/>
                </svg>

                <div class="confirmation-title">
                    Congratulations!<br>
                    Your registration is successful!
                </div>

                <div class="confirmation subtitle">Thank you for joining us! Let’s get started, please enjoy</div>

                <a href="{{ route('page', 'dashboard') }}" class="btn btn-blue">Go to the Dashboard</a>
            </div>

        </div>
    </section>

@endsection

@section('scripts')
@endsection
