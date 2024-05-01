<header class="header">
    <div class="wrapper-container">
        <div class="header-wrapper flex align-center">
            <div class="header-logo">
                <a href="{{ route('home') }}">
                    <img width="120" height="60" src="{{ header_logo_url() }}" alt="logo">
{{--                    <img width="118" height="44" src="{{ asset('images/logo-career.svg') }}" alt="logo">--}}
                </a>
            </div>
            <div class="header-menu flex align-center flex-between">
                <ul class="header-menu-list flex align-center">
                    @foreach($menu as $item)
                    <li class="header-menu-item @if($item->isPageActive()) active @endif">
                        <a class="helvetica fw-medium fz-020 black" href="{{ $item->url }}" @if($item->in_new_tab) target="_blank" @endif>{{ $item->title }}</a>
                    </li>
                    @endforeach
                </ul>

                <div class="header-buttons flex align-center">
                    @if(auth()->check() && auth()->user()->hasRole())
                        <a class="btn btn-blue" href="{{ route('page', 'dashboard') }}">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-clear">Log Out</button>
                        </form>
                    @else
                        <a class="btn btn-blue-clear" href="{{ route('login') }}">Log In</a>
                        @if(App\Services\SettingService::canRegister())
                            <a class="btn btn-blue" href="{{ route('register') }}">Get Started</a>
                        @endif
                    @endif
                </div>
            </div>
            <div class="header-burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</header>
