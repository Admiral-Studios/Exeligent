@php($executiveSearchService = new \App\Services\ExecutiveSearchService())

<div id="mainBlock" style="padding-bottom: 32px">
    <form>
        <div class="search-section">
            <input class="a-input-search mirror" data-name="search" type="search" name="query" id="search"
                   placeholder="Find an executive, headhunter, or company"
                   value="{{ explode('|', request()->input('query'))[0] }}">

            @foreach(\App\Models\Executive::ALL_PROPERTIES as $filter_property)
                <input type="hidden" name="{{ $filter_property }}"
                       value="{{ $executiveSearchService->getFilteredPropertyValues($filter_property) }}">
            @endforeach

            {{--            <input class="a-input a-input-brand tt-input" name="region" type="text"--}}
            {{--                   placeholder="Enter Region" data-only="State"--}}
            {{--                   value="{{ request()->input('region') }}" autocomplete="off"--}}
            {{--                   spellcheck="false" dir="auto"--}}
            {{--                   style="position: relative; vertical-align: top; background-color: transparent;">--}}

            <div class="dropdown">
                @php($region = request()->input('region'))
                <button class="dropdown__button" type="button">{{ $region ? ($region == 'USA' ? $region : ucfirst(strtolower($region))) : 'Choose region...' }}</button>
                <ul class="dropdown__list">
                    @foreach(\App\Enums\ExecutiveRegionEnum::cases() as $regionEnum)
                        <li class="dropdown__list-item @if($region == $regionEnum->name) dropdown__list-item_active @endif" data-value="{{ $regionEnum->name }}">{{ $regionEnum->name == 'USA' ? $regionEnum->name : ucfirst(strtolower($regionEnum->name)) }}</li>
                    @endforeach
                    <input class="dropdown__input_hidden" type="text" name="region" value="{{ $region }}">
                </ul>
            </div>

            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                    <path
                        d="M13.6743 2.41406C7.47592 2.41406 2.42676 7.46321 2.42676 13.6616C2.42676 19.86 7.47592 24.919 13.6743 24.919C16.3218 24.919 18.7567 23.9912 20.6812 22.4507L25.3662 27.1333C25.6026 27.3599 25.9184 27.485 26.2459 27.4816C26.5734 27.4783 26.8866 27.3468 27.1183 27.1154C27.3501 26.884 27.482 26.5711 27.4858 26.2436C27.4896 25.9161 27.365 25.6001 27.1387 25.3634L22.4536 20.6783C23.9954 18.751 24.9243 16.3122 24.9243 13.6616C24.9243 7.46321 19.8727 2.41406 13.6743 2.41406ZM13.6743 4.9141C18.5216 4.9141 22.4219 8.81435 22.4219 13.6616C22.4219 18.5089 18.5216 22.419 13.6743 22.419C8.82702 22.419 4.92676 18.5089 4.92676 13.6616C4.92676 8.81435 8.82702 4.9141 13.6743 4.9141Z"
                        fill="white"/>
                </svg>
                <span>Search</span>
            </button>
        </div>
    </form>

    @php($filters = $executiveSearchService->getFilters())
    @if($filters->isNotEmpty())
        <div class="search-filters">
            <div class="title small">Filters</div>
            <div id="executiveFilters" class="filters">
                @foreach($filters as $filter)
                    <div class="filter choose" data-name="{{ $filter->name }}"
                         data-values="{{ json_encode($filter->values) }}">{{ $filter->title }}</div>
                @endforeach
                {{--        <button class="btn-filters">--}}
                {{--            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="8" viewBox="0 0 20 8" fill="none">--}}
                {{--                <path d="M4.16667 2.3999C3.25 2.3999 2.5 3.1199 2.5 3.9999C2.5 4.8799 3.25 5.5999 4.16667 5.5999C5.08333 5.5999 5.83333 4.8799 5.83333 3.9999C5.83333 3.1199 5.08333 2.3999 4.16667 2.3999Z" fill="white"/>--}}
                {{--                <path d="M15.8332 2.3999C14.9165 2.3999 14.1665 3.1199 14.1665 3.9999C14.1665 4.8799 14.9165 5.5999 15.8332 5.5999C16.7498 5.5999 17.4998 4.8799 17.4998 3.9999C17.4998 3.1199 16.7498 2.3999 15.8332 2.3999Z" fill="white"/>--}}
                {{--                <path d="M10.0002 2.3999C9.0835 2.3999 8.3335 3.1199 8.3335 3.9999C8.3335 4.8799 9.0835 5.5999 10.0002 5.5999C10.9168 5.5999 11.6668 4.8799 11.6668 3.9999C11.6668 3.1199 10.9168 2.3999 10.0002 2.3999Z" fill="white"/>--}}
                {{--            </svg>--}}
                {{--            More Filters--}}
                {{--        </button>--}}
            </div>
        </div>
    @endif

    @php($executives = $executiveSearchService->getFilteredExecutives())

    @if($executives)
        @if($executives->isNotEmpty())
            <div class="search-title">
                Search Results

                <div class="positions-btn">
                    <svg class="btn-block" width="18" height="18" viewBox="0 0 18 18" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2 8H6C7.1 8 8 7.1 8 6V2C8 0.9 7.1 0 6 0H2C0.9 0 0 0.9 0 2V6C0 7.1 0.9 8 2 8ZM2 18H6C7.1 18 8 17.1 8 16V12C8 10.9 7.1 10 6 10H2C0.9 10 0 10.9 0 12V16C0 17.1 0.9 18 2 18ZM10 2V6C10 7.1 10.9 8 12 8H16C17.1 8 18 7.1 18 6V2C18 0.9 17.1 0 16 0H12C10.9 0 10 0.9 10 2ZM12 18H16C17.1 18 18 17.1 18 16V12C18 10.9 17.1 10 16 10H12C10.9 10 10 10.9 10 12V16C10 17.1 10.9 18 12 18Z"/>
                    </svg>
                    <svg class="decor" width="1" height="24" viewBox="0 0 1 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <rect width="1" height="24" fill="#D9D9D9"/>
                    </svg>
                    <svg class="btn-rows" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3 21H20C20.55 21 21 20.55 21 20V19C21 18.45 20.55 18 20 18H3C2.45 18 2 18.45 2 19V20C2 20.55 2.45 21 3 21ZM20 8H3C2.45 8 2 8.45 2 9V15C2 15.55 2.45 16 3 16H20C20.55 16 21 15.55 21 15V9C21 8.45 20.55 8 20 8ZM2 4V5C2 5.55 2.45 6 3 6H20C20.55 6 21 5.55 21 5V4C21 3.45 20.55 3 20 3H3C2.45 3 2 3.45 2 4Z"/>
                    </svg>
                </div>
            </div>

            <div class="search-contacts blocks">
                @foreach($executives as $executive)
                    <a href="{{ route('user.search.show', $executive) }}" class="search-contacts-item show-executive">
                        <div class="category-box">
                            <div class="category{{ empty($executive->industry_title) ? ' empty' : '' }}">
                                {{ $executive->industry_title }}
                            </div>
                        </div>

                        <div class="name">{{ $executive->full_name }}</div>

                        <div class="decor"></div>
                        <div class="additional-info">
                            <div class="job-title">{{ $executive->job_title }}</div>
                        </div>
                        <div class="contact-btn">
                            <div class="city">
                                @if($executive->address)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                         viewBox="0 0 14 14" fill="none">
                                        <mask id="mask0_1362_4814" style="mask-type:luminance"
                                              maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">
                                            <path d="M0 0H14V14H0V0Z" fill="white"/>
                                        </mask>
                                        <g mask="url(#mask0_1362_4814)">
                                            <path
                                                d="M7 13.5898C5.35938 11.1289 2.48828 7.79297 2.48828 4.92188C2.48828 2.43411 4.51224 0.410156 7 0.410156C9.48776 0.410156 11.5117 2.43411 11.5117 4.92188C11.5117 7.79297 8.64063 11.1289 7 13.5898Z"
                                                stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path
                                                d="M7 6.97266C5.86925 6.97266 4.94922 6.05262 4.94922 4.92187C4.94922 3.79113 5.86925 2.87109 7 2.87109C8.13075 2.87109 9.05078 3.79113 9.05078 4.92187C9.05078 6.05262 8.13075 6.97266 7 6.97266Z"
                                                stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </g>
                                    </svg>
                                    <span>
                                         {{ $executive->address }}
                                        </span>
                                @endif
                            </div>

                            <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="18" height="24"
                                 viewBox="0 0 18 24"
                                 fill="none">
                                <g clip-path="url(#clip0_1362_4805)">
                                    <path
                                        d="M17.8414 11.6153L12.387 6.16088C12.1911 5.93209 11.8467 5.90542 11.618 6.1014C11.3892 6.29733 11.3625 6.64167 11.5585 6.87046C11.5768 6.89179 11.5966 6.91171 11.618 6.92995L16.1397 11.4571H1C0.698786 11.4571 0.454572 11.7014 0.454572 12.0026C0.454572 12.3039 0.698786 12.5481 1 12.5481H16.1397L11.618 17.0698C11.3892 17.2657 11.3625 17.61 11.5585 17.8388C11.7545 18.0676 12.0987 18.0943 12.3275 17.8983C12.3489 17.88 12.3688 17.8602 12.387 17.8388L17.8415 12.3844C18.0529 12.1717 18.0529 11.8281 17.8414 11.6153Z"
                                        fill="#1F7CEC"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1362_4805">
                                        <rect width="18" height="24" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                    </a>
                @endforeach

                <div class="pagination-wrapper">
                    {{ $executives->withQueryString()->links('vendor.pagination.executive-search') }}
                </div>

            </div>
        @else
            <div class="search-title">There is no results...</div>
        @endif
    @endif


    {{--<div class="search-title">Most Recent Search</div>--}}
    {{--<div class="search-contacts">--}}
    {{--    <div class="search-contacts-item">--}}
    {{--        <div class="img">--}}
    {{--            <div class="category">E-commerce</div>--}}
    {{--            <img src="{{ asset('images/search-page/search-contacts.png') }}" alt="img">--}}
    {{--        </div>--}}
    {{--        <div class="info">--}}
    {{--            <div class="name">Tobi Lutke</div>--}}
    {{--            <div class="additional-info">--}}
    {{--                <div class="job-title">CEO, Shopify</div>--}}
    {{--                <div class="city">--}}
    {{--                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">--}}
    {{--                        <mask id="mask0_1362_4814" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">--}}
    {{--                            <path d="M0 0H14V14H0V0Z" fill="white"/>--}}
    {{--                        </mask>--}}
    {{--                        <g mask="url(#mask0_1362_4814)">--}}
    {{--                            <path d="M7 13.5898C5.35938 11.1289 2.48828 7.79297 2.48828 4.92188C2.48828 2.43411 4.51224 0.410156 7 0.410156C9.48776 0.410156 11.5117 2.43411 11.5117 4.92188C11.5117 7.79297 8.64063 11.1289 7 13.5898Z" stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
    {{--                            <path d="M7 6.97266C5.86925 6.97266 4.94922 6.05262 4.94922 4.92187C4.94922 3.79113 5.86925 2.87109 7 2.87109C8.13075 2.87109 9.05078 3.79113 9.05078 4.92187C9.05078 6.05262 8.13075 6.97266 7 6.97266Z" stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
    {{--                        </g>--}}
    {{--                    </svg>--}}
    {{--                    Ottawa, CA--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="decor"></div>--}}
    {{--            <a class="contact-btn" href="">--}}
    {{--                Contact Now--}}
    {{--                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24" fill="none">--}}
    {{--                    <g clip-path="url(#clip0_1362_4805)">--}}
    {{--                        <path d="M17.8414 11.6153L12.387 6.16088C12.1911 5.93209 11.8467 5.90542 11.618 6.1014C11.3892 6.29733 11.3625 6.64167 11.5585 6.87046C11.5768 6.89179 11.5966 6.91171 11.618 6.92995L16.1397 11.4571H1C0.698786 11.4571 0.454572 11.7014 0.454572 12.0026C0.454572 12.3039 0.698786 12.5481 1 12.5481H16.1397L11.618 17.0698C11.3892 17.2657 11.3625 17.61 11.5585 17.8388C11.7545 18.0676 12.0987 18.0943 12.3275 17.8983C12.3489 17.88 12.3688 17.8602 12.387 17.8388L17.8415 12.3844C18.0529 12.1717 18.0529 11.8281 17.8414 11.6153Z" fill="#1F7CEC"/>--}}
    {{--                    </g>--}}
    {{--                    <defs>--}}
    {{--                        <clipPath id="clip0_1362_4805">--}}
    {{--                            <rect width="18" height="24" fill="white"/>--}}
    {{--                        </clipPath>--}}
    {{--                    </defs>--}}
    {{--                </svg>--}}
    {{--            </a>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <div class="search-contacts-item">--}}
    {{--        <div class="img">--}}
    {{--            <div class="category">E-commerce</div>--}}
    {{--            <img src="{{ asset('images/search-page/search-contacts.png') }}" alt="img">--}}
    {{--        </div>--}}
    {{--        <div class="info">--}}
    {{--            <div class="name">Tobi Lutke</div>--}}
    {{--            <div class="additional-info">--}}
    {{--                <div class="job-title">CEO, Shopify</div>--}}
    {{--                <div class="city">--}}
    {{--                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">--}}
    {{--                        <mask id="mask0_1362_4814" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">--}}
    {{--                            <path d="M0 0H14V14H0V0Z" fill="white"/>--}}
    {{--                        </mask>--}}
    {{--                        <g mask="url(#mask0_1362_4814)">--}}
    {{--                            <path d="M7 13.5898C5.35938 11.1289 2.48828 7.79297 2.48828 4.92188C2.48828 2.43411 4.51224 0.410156 7 0.410156C9.48776 0.410156 11.5117 2.43411 11.5117 4.92188C11.5117 7.79297 8.64063 11.1289 7 13.5898Z" stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
    {{--                            <path d="M7 6.97266C5.86925 6.97266 4.94922 6.05262 4.94922 4.92187C4.94922 3.79113 5.86925 2.87109 7 2.87109C8.13075 2.87109 9.05078 3.79113 9.05078 4.92187C9.05078 6.05262 8.13075 6.97266 7 6.97266Z" stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
    {{--                        </g>--}}
    {{--                    </svg>--}}
    {{--                    Ottawa, CA--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="decor"></div>--}}
    {{--            <a class="contact-btn" href="">--}}
    {{--                Contact Now--}}
    {{--                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24" fill="none">--}}
    {{--                    <g clip-path="url(#clip0_1362_4805)">--}}
    {{--                        <path d="M17.8414 11.6153L12.387 6.16088C12.1911 5.93209 11.8467 5.90542 11.618 6.1014C11.3892 6.29733 11.3625 6.64167 11.5585 6.87046C11.5768 6.89179 11.5966 6.91171 11.618 6.92995L16.1397 11.4571H1C0.698786 11.4571 0.454572 11.7014 0.454572 12.0026C0.454572 12.3039 0.698786 12.5481 1 12.5481H16.1397L11.618 17.0698C11.3892 17.2657 11.3625 17.61 11.5585 17.8388C11.7545 18.0676 12.0987 18.0943 12.3275 17.8983C12.3489 17.88 12.3688 17.8602 12.387 17.8388L17.8415 12.3844C18.0529 12.1717 18.0529 11.8281 17.8414 11.6153Z" fill="#1F7CEC"/>--}}
    {{--                    </g>--}}
    {{--                    <defs>--}}
    {{--                        <clipPath id="clip0_1362_4805">--}}
    {{--                            <rect width="18" height="24" fill="white"/>--}}
    {{--                        </clipPath>--}}
    {{--                    </defs>--}}
    {{--                </svg>--}}
    {{--            </a>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <div class="search-contacts-item">--}}
    {{--        <div class="img">--}}
    {{--            <div class="category">E-commerce</div>--}}
    {{--            <img src="{{ asset('images/search-page/search-contacts.png') }}" alt="img">--}}
    {{--        </div>--}}
    {{--        <div class="info">--}}
    {{--            <div class="name">Tobi Lutke</div>--}}
    {{--            <div class="additional-info">--}}
    {{--                <div class="job-title">CEO, Shopify</div>--}}
    {{--                <div class="city">--}}
    {{--                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">--}}
    {{--                        <mask id="mask0_1362_4814" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="14" height="14">--}}
    {{--                            <path d="M0 0H14V14H0V0Z" fill="white"/>--}}
    {{--                        </mask>--}}
    {{--                        <g mask="url(#mask0_1362_4814)">--}}
    {{--                            <path d="M7 13.5898C5.35938 11.1289 2.48828 7.79297 2.48828 4.92188C2.48828 2.43411 4.51224 0.410156 7 0.410156C9.48776 0.410156 11.5117 2.43411 11.5117 4.92188C11.5117 7.79297 8.64063 11.1289 7 13.5898Z" stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
    {{--                            <path d="M7 6.97266C5.86925 6.97266 4.94922 6.05262 4.94922 4.92187C4.94922 3.79113 5.86925 2.87109 7 2.87109C8.13075 2.87109 9.05078 3.79113 9.05078 4.92187C9.05078 6.05262 8.13075 6.97266 7 6.97266Z" stroke="#A7AEC1" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>--}}
    {{--                        </g>--}}
    {{--                    </svg>--}}
    {{--                    Ottawa, CA--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="decor"></div>--}}
    {{--            <a class="contact-btn" href="">--}}
    {{--                Contact Now--}}
    {{--                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" viewBox="0 0 18 24" fill="none">--}}
    {{--                    <g clip-path="url(#clip0_1362_4805)">--}}
    {{--                        <path d="M17.8414 11.6153L12.387 6.16088C12.1911 5.93209 11.8467 5.90542 11.618 6.1014C11.3892 6.29733 11.3625 6.64167 11.5585 6.87046C11.5768 6.89179 11.5966 6.91171 11.618 6.92995L16.1397 11.4571H1C0.698786 11.4571 0.454572 11.7014 0.454572 12.0026C0.454572 12.3039 0.698786 12.5481 1 12.5481H16.1397L11.618 17.0698C11.3892 17.2657 11.3625 17.61 11.5585 17.8388C11.7545 18.0676 12.0987 18.0943 12.3275 17.8983C12.3489 17.88 12.3688 17.8602 12.387 17.8388L17.8415 12.3844C18.0529 12.1717 18.0529 11.8281 17.8414 11.6153Z" fill="#1F7CEC"/>--}}
    {{--                    </g>--}}
    {{--                    <defs>--}}
    {{--                        <clipPath id="clip0_1362_4805">--}}
    {{--                            <rect width="18" height="24" fill="white"/>--}}
    {{--                        </clipPath>--}}
    {{--                    </defs>--}}
    {{--                </svg>--}}
    {{--            </a>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}

</div>

<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     const btnBlock = document.querySelector('.btn-block');
    //     const btnRows = document.querySelector('.btn-rows');
    //     const searchContacts = document.querySelector('.search-contacts');
    //     const positionWrapper = document.querySelector('.positions-btn');
    //
    //     btnBlock.classList.add('active');
    //
    //     function updateLayout() {
    //         const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    //
    //         if (isMobile) {
    //             positionWrapper.style.display = 'none';
    //             btnRows.style.display = 'none';
    //             searchContacts.classList.add('blocks');
    //             searchContacts.classList.remove('rows');
    //         } else {
    //             positionWrapper.style.display = 'flex';
    //             btnRows.style.display = 'block';
    //
    //             btnRows.addEventListener('click', function () {
    //                 searchContacts.classList.add('rows');
    //                 searchContacts.classList.remove('blocks');
    //                 btnRows.classList.add('active');
    //                 btnBlock.classList.remove('active');
    //             });
    //
    //             btnBlock.addEventListener('click', function () {
    //                 searchContacts.classList.remove('rows');
    //                 searchContacts.classList.add('blocks');
    //                 btnRows.classList.remove('active');
    //                 btnBlock.classList.add('active');
    //             });
    //         }
    //     }
    //
    //     updateLayout();
    //     window.addEventListener('resize', updateLayout);
    // });
</script>


<div id="showBlock" style="display:none;padding-bottom: 32px"></div>

@push('scripts')
    <script src="{{ asset('js/executive-search.js') }}"></script>
    <script src="{{ asset('js/select.js') }}"></script>
@endpush
