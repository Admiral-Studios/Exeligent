@extends("layouts.user")

@section('title', 'New Page')

@section('content')

    <div class="search-text-section">
        <div class="title">Connect with Fortune 500 Executives</div>
        <div class="description">Search by industries, companies, job titles, and descriptions to find a direct contact
            towards your dream job
        </div>
    </div>

    <div class="search-section">
        <input class="a-input-search mirror" data-name="search" type="search" name="search" id="search"
               placeholder="Find an executive, headhunter, or company" value="{{ request()->input('search') }}">

        <button type="submit" form="filterForm">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path
                    d="M13.6743 2.41406C7.47592 2.41406 2.42676 7.46321 2.42676 13.6616C2.42676 19.86 7.47592 24.919 13.6743 24.919C16.3218 24.919 18.7567 23.9912 20.6812 22.4507L25.3662 27.1333C25.6026 27.3599 25.9184 27.485 26.2459 27.4816C26.5734 27.4783 26.8866 27.3468 27.1183 27.1154C27.3501 26.884 27.482 26.5711 27.4858 26.2436C27.4896 25.9161 27.365 25.6001 27.1387 25.3634L22.4536 20.6783C23.9954 18.751 24.9243 16.3122 24.9243 13.6616C24.9243 7.46321 19.8727 2.41406 13.6743 2.41406ZM13.6743 4.9141C18.5216 4.9141 22.4219 8.81435 22.4219 13.6616C22.4219 18.5089 18.5216 22.419 13.6743 22.419C8.82702 22.419 4.92676 18.5089 4.92676 13.6616C4.92676 8.81435 8.82702 4.9141 13.6743 4.9141Z"
                    fill="white"/>
            </svg>
            <span>Find Executives</span>
        </button>
    </div>

    <div class="search-filters">
        <div class="title small">Filters</div>
        <div class="filters">
            <div class="filter choose">E-Commerce</div>
            <div class="filter choose">Manufacturing</div>
            <div class="filter choose">Software</div>
            <div class="filter choose">Finance</div>
            <div class="filter choose">Pharma</div>
            <div class="filter choose">IT</div>
            <div class="filter choose">Compliance</div>
            <div class="filter choose">Accounting</div>
            <button class="btn-filters">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="8" viewBox="0 0 20 8" fill="none">
                    <path d="M4.16667 2.3999C3.25 2.3999 2.5 3.1199 2.5 3.9999C2.5 4.8799 3.25 5.5999 4.16667 5.5999C5.08333 5.5999 5.83333 4.8799 5.83333 3.9999C5.83333 3.1199 5.08333 2.3999 4.16667 2.3999Z" fill="white"/>
                    <path d="M15.8332 2.3999C14.9165 2.3999 14.1665 3.1199 14.1665 3.9999C14.1665 4.8799 14.9165 5.5999 15.8332 5.5999C16.7498 5.5999 17.4998 4.8799 17.4998 3.9999C17.4998 3.1199 16.7498 2.3999 15.8332 2.3999Z" fill="white"/>
                    <path d="M10.0002 2.3999C9.0835 2.3999 8.3335 3.1199 8.3335 3.9999C8.3335 4.8799 9.0835 5.5999 10.0002 5.5999C10.9168 5.5999 11.6668 4.8799 11.6668 3.9999C11.6668 3.1199 10.9168 2.3999 10.0002 2.3999Z" fill="white"/>
                </svg>
                More Filters
            </button>
        </div>
    </div>

    <div class="search-title">Most Recent Search</div>

    <div class="search-contacts">
        <div class="search-contacts-item">
            <div class="img">
                <div class="category">E-commerce</div>
                <img src="{{ asset('images/search-page/search-contacts.png') }}" alt="img">
            </div>
            <div class="info">
                <div class="name">Tobi Lutke</div>
                <div class="additional-info">
                    <div class="job-title">CEO, Shopify</div>
                    <div class="city">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <mask id="mask0_1362_4814" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">
                                <path d="M0 0H14V14H0V0Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask0_1362_4814)">
                                <path d="M7 13.5898C5.35938 11.1289 2.48828 7.79297 2.48828 4.92188C2.48828 2.43411 4.51224 0.410156 7 0.410156C9.48776 0.410156 11.5117 2.43411 11.5117 4.92188C11.5117 7.79297 8.64063 11.1289 7 13.5898Z" stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 6.97266C5.86925 6.97266 4.94922 6.05262 4.94922 4.92187C4.94922 3.79113 5.86925 2.87109 7 2.87109C8.13075 2.87109 9.05078 3.79113 9.05078 4.92187C9.05078 6.05262 8.13075 6.97266 7 6.97266Z" stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                        </svg>
                        Ottawa, CA
                    </div>
                </div>
                <div class="decor"></div>
                <a class="contact-btn" href="">
                    Contact Now
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24" fill="none">
                        <g clip-path="url(#clip0_1362_4805)">
                            <path d="M17.8414 11.6153L12.387 6.16088C12.1911 5.93209 11.8467 5.90542 11.618 6.1014C11.3892 6.29733 11.3625 6.64167 11.5585 6.87046C11.5768 6.89179 11.5966 6.91171 11.618 6.92995L16.1397 11.4571H1C0.698786 11.4571 0.454572 11.7014 0.454572 12.0026C0.454572 12.3039 0.698786 12.5481 1 12.5481H16.1397L11.618 17.0698C11.3892 17.2657 11.3625 17.61 11.5585 17.8388C11.7545 18.0676 12.0987 18.0943 12.3275 17.8983C12.3489 17.88 12.3688 17.8602 12.387 17.8388L17.8415 12.3844C18.0529 12.1717 18.0529 11.8281 17.8414 11.6153Z" fill="#1F7CEC"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_1362_4805">
                                <rect width="18" height="24" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </a>
            </div>
        </div>
        <div class="search-contacts-item">
            <div class="img">
                <div class="category">E-commerce</div>
                <img src="{{ asset('images/search-page/search-contacts.png') }}" alt="img">
            </div>
            <div class="info">
                <div class="name">Tobi Lutke</div>
                <div class="additional-info">
                    <div class="job-title">CEO, Shopify</div>
                    <div class="city">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <mask id="mask0_1362_4814" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">
                                <path d="M0 0H14V14H0V0Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask0_1362_4814)">
                                <path d="M7 13.5898C5.35938 11.1289 2.48828 7.79297 2.48828 4.92188C2.48828 2.43411 4.51224 0.410156 7 0.410156C9.48776 0.410156 11.5117 2.43411 11.5117 4.92188C11.5117 7.79297 8.64063 11.1289 7 13.5898Z" stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 6.97266C5.86925 6.97266 4.94922 6.05262 4.94922 4.92187C4.94922 3.79113 5.86925 2.87109 7 2.87109C8.13075 2.87109 9.05078 3.79113 9.05078 4.92187C9.05078 6.05262 8.13075 6.97266 7 6.97266Z" stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                        </svg>
                        Ottawa, CA
                    </div>
                </div>
                <div class="decor"></div>
                <a class="contact-btn" href="">
                    Contact Now
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24" fill="none">
                        <g clip-path="url(#clip0_1362_4805)">
                            <path d="M17.8414 11.6153L12.387 6.16088C12.1911 5.93209 11.8467 5.90542 11.618 6.1014C11.3892 6.29733 11.3625 6.64167 11.5585 6.87046C11.5768 6.89179 11.5966 6.91171 11.618 6.92995L16.1397 11.4571H1C0.698786 11.4571 0.454572 11.7014 0.454572 12.0026C0.454572 12.3039 0.698786 12.5481 1 12.5481H16.1397L11.618 17.0698C11.3892 17.2657 11.3625 17.61 11.5585 17.8388C11.7545 18.0676 12.0987 18.0943 12.3275 17.8983C12.3489 17.88 12.3688 17.8602 12.387 17.8388L17.8415 12.3844C18.0529 12.1717 18.0529 11.8281 17.8414 11.6153Z" fill="#1F7CEC"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_1362_4805">
                                <rect width="18" height="24" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </a>
            </div>
        </div>
        <div class="search-contacts-item">
            <div class="img">
                <div class="category">E-commerce</div>
                <img src="{{ asset('images/search-page/search-contacts.png') }}" alt="img">
            </div>
            <div class="info">
                <div class="name">Tobi Lutke</div>
                <div class="additional-info">
                    <div class="job-title">CEO, Shopify</div>
                    <div class="city">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <mask id="mask0_1362_4814" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">
                                <path d="M0 0H14V14H0V0Z" fill="white"/>
                            </mask>
                            <g mask="url(#mask0_1362_4814)">
                                <path d="M7 13.5898C5.35938 11.1289 2.48828 7.79297 2.48828 4.92188C2.48828 2.43411 4.51224 0.410156 7 0.410156C9.48776 0.410156 11.5117 2.43411 11.5117 4.92188C11.5117 7.79297 8.64063 11.1289 7 13.5898Z" stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 6.97266C5.86925 6.97266 4.94922 6.05262 4.94922 4.92187C4.94922 3.79113 5.86925 2.87109 7 2.87109C8.13075 2.87109 9.05078 3.79113 9.05078 4.92187C9.05078 6.05262 8.13075 6.97266 7 6.97266Z" stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            </g>
                        </svg>
                        Ottawa, CA
                    </div>
                </div>
                <div class="decor"></div>
                <a class="contact-btn" href="">
                    Contact Now
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24" fill="none">
                        <g clip-path="url(#clip0_1362_4805)">
                            <path d="M17.8414 11.6153L12.387 6.16088C12.1911 5.93209 11.8467 5.90542 11.618 6.1014C11.3892 6.29733 11.3625 6.64167 11.5585 6.87046C11.5768 6.89179 11.5966 6.91171 11.618 6.92995L16.1397 11.4571H1C0.698786 11.4571 0.454572 11.7014 0.454572 12.0026C0.454572 12.3039 0.698786 12.5481 1 12.5481H16.1397L11.618 17.0698C11.3892 17.2657 11.3625 17.61 11.5585 17.8388C11.7545 18.0676 12.0987 18.0943 12.3275 17.8983C12.3489 17.88 12.3688 17.8602 12.387 17.8388L17.8415 12.3844C18.0529 12.1717 18.0529 11.8281 17.8414 11.6153Z" fill="#1F7CEC"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_1362_4805">
                                <rect width="18" height="24" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="search-text-img left">
        <div class="text">
            <div class="title">
                <span>Find</span>
                Opportunities Quickly
            </div>
            <div class="description">
                Our search database puts you in direct contact with influential professionals who can open doors and
                create opportunities that were once out of reach.
            </div>
        </div>
        <div class="img">
            <img src="{{ asset('images/search-page/search-1.svg') }}" alt="img">
        </div>
    </div>

    <div class="search-text-img right">
        <div class="text">
            <div class="title">
                <span>Join</span>
                Elite Groups
            </div>
            <div class="description">
                Build connections with headhunters and decision-makers in your field and be the first to learn about
                exciting career opportunities.
            </div>
        </div>
        <div class="img">
            <img src="{{ asset('images/search-page/search-2.svg') }}" alt="img">
        </div>
    </div>

    <div class="search-text-img left">
        <div class="text">
            <div class="title">
                <span>Become</span>
                an Industry Leader
            </div>
            <div class="description">
                Maximize your networking efforts by creating new connections, engaging in meaningful conversations,
                keeping track of progress, and staying up-to-date in your industry.
            </div>
        </div>
        <div class="img">
            <img src="{{ asset('images/search-page/search-3.svg') }}" alt="img">
        </div>
    </div>

    <div class="search-filters">
        <div class="title big">Start Your Search By Titles</div>
        <ul class="filters">
            <li class="filter">CFOs</li>
            <li class="filter">Board Member</li>
            <li class="filter">Asset Manager</li>
            <li class="filter">General Counsels</li>
            <li class="filter">Directors</li>
            <li class="filter">Academic Leaders</li>
            <li class="filter">CTO’s</li>
            <li class="filter">Financial Exec</li>
        </ul>
    </div>

    <div class="search-text-section">
        <div class="title">
            “You’re one connection away from your dream opportunity”
        </div>
    </div>

@endsection
