@extends("layouts.front")

@section('title', 'Ooops... Page is not found')

@section('content')
    <style>
        .flexible-section .flexible-wrapper .title {
            color: #c03b3b;
        }

        .flexible-section .flexible-wrapper .title span {
            color: #ff0000;
        }
    </style>

    <section class="section flexible-section">
        <div class="wrapper-container">
            <div class="flexible-wrapper">
                <h2 class="title"><span>404</span> Page is not found</h2>
                <div class="description"><p>We're sorry, but the page you're trying to access does not exist</p></div>
                <hr>
                <a class="btn btn-black" href="{{ route('page', 'contact') }}">Contact Us</a>
                <a class="btn btn-black" href="/">Home</a>
            </div>
        </div>
    </section>

@endsection
