@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

    <section class="section login-section">
        <div class="login-section-wrapper">
            <div class="login-section-box check">
                <svg width="81" height="80" viewBox="0 0 81 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3" d="M67.1663 26.6667V40.2667C66.0663 40.1 64.9663 40 63.833 40C52.0663 40 42.3997 48.7 40.7663 60H13.833V26.6667L40.4997 43.3333L67.1663 26.6667ZM67.1663 20H13.833L40.4997 36.6667L67.1663 20Z" fill="#027FFE"/>
                    <path d="M40.767 59.9999H13.8337V26.6666L40.5003 43.3333L67.167 26.6666V40.2666C69.5337 40.5999 71.767 41.2999 73.8337 42.2666V19.9999C73.8337 16.3333 70.8337 13.3333 67.167 13.3333H13.8337C10.167 13.3333 7.20033 16.3333 7.20033 19.9999L7.16699 59.9999C7.16699 63.6666 10.167 66.6666 13.8337 66.6666H40.767C40.6003 65.5666 40.5003 64.4666 40.5003 63.3333C40.5003 62.1999 40.6003 61.0999 40.767 59.9999ZM67.167 19.9999L40.5003 36.6666L13.8337 19.9999H67.167ZM58.3003 73.3333L46.5003 61.5332L51.2003 56.8332L58.267 63.8999L72.4003 49.7666L77.167 54.4666L58.3003 73.3333Z" fill="#027FFE"/>
                </svg>
                <div class="title">
                    Link was sent!<br>
                    Please check your email
                </div>
                <div class="description">
                    Before proceeding please check your email for verification link.
                    If you don’t receive an email - <a href="{{ route('password.request') }}">click here to request another</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let currentDate = new Date();

            let monthNames = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];

            let month = monthNames[currentDate.getMonth()];
            let day = currentDate.getDate();
            let year = currentDate.getFullYear();

            document.getElementById("currentDate").innerText = month + " " + day + ", " + year;


            let subscriptionItems = document.querySelectorAll('.subscription-choice__item');

            subscriptionItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    subscriptionItems.forEach(function (item) {
                        item.classList.remove('active');
                    });

                    item.classList.add('active');

                    let radio = item.querySelector('input[type="radio"]');
                    radio.checked = true;

                    let price = item.querySelector('.price').textContent;

                    let registerPaymentInfoPrice = document.querySelector('.register-payment-info .price');
                    registerPaymentInfoPrice.textContent = price;
                });
            });
        })
    </script>

@endsection
