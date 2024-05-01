<div class="sidebar-profile">
    <a href="{{ route('user.profile') }}" class="flex align-center @if(request()->routeIs('user.profile')) active-menu @endif">
        <img width="42" height="42" src="{{ asset('images/sidebar/profile.svg') }}" alt="profile img">
        <span>My Profile</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M8.95019 4.07992L15.4702 10.5999C16.2402 11.3699 16.2402 12.6299 15.4702 13.3999L8.9502 19.9199" stroke="#2C3659" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
</div>

<div class="sidebar-menu flex flow-column">
    @foreach($menus as $menu)
    <a href="{{ $menu->url }}" class="sidebar-menu-item @if($menu->isPageActive()) active-menu @endif">
        @if($menu->active_icon && $menu->isPageActive())
            <img width="24" height="24" src="{{ $menu->getActiveIconSrc() }}" alt="{{ $menu->title }}">
        @elseif($menu->icon)
            <img width="24" height="24" src="{{ $menu->getIconSrc() }}" alt="{{ $menu->title }}">
        @endif
        {{ $menu->title }}
    </a>
    @endforeach
</div>

<div class="sidebar-menu flex flow-column">
    <form action="{{ route('logout') }}" method="POST" style="width: 100%;;">
        @csrf
        <button type="submit" class="sidebar-menu-item" style="width: 100%;">
            <img width="24" height="24" src="{{ asset('images/sidebar/logout.svg') }}" alt="profile img">
            Logout
        </button>
    </form>
</div>
