<footer class="footer">
    <div class="wrapper-container">
        <div class="footer-wrapper flex">

            <a class="footer-logo" href="{{ route('home') }}">
                <img width="120" height="60" src="{{ footer_logo_url() }}" alt="logo">
{{--                <img width="118" height="44" src="{{ asset('images/logo-career.svg') }}" alt="logo">--}}
            </a>

            @php($main_menu = $menu->shift())
            @if($main_menu && $main_menu->is_active)
                <ul class="menu-list">
                    @foreach($main_menu->active_menus as $item)
                    <li>
                        <a href="{{ $item->url }}">{{ $item->title }}</a>
                    </li>
                    @endforeach
                </ul>
            @endif

            @php($contact_menu = $menu->shift())
            @if($contact_menu && $contact_menu->is_active)
                <div class="contacts">
                    <div class="title">Contact Us</div>
                    <ul class="contacts__list">
                        @foreach($contact_menu->active_menus as $item)
                        <li>
                            <a href="{{ $item->url }}">{{ $item->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>

        <div class="footer-copyright">
            <span>
                AKC© All Rights Reserved
            </span>

            @php($bottom_menu = $menu->shift())
            @if($bottom_menu && $bottom_menu->is_active)
                <ul class="menu-list">
                    @foreach($bottom_menu->active_menus as $item)
                        <li>
                            <a href="{{ $item->url }}">{{ $item->title }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</footer>
