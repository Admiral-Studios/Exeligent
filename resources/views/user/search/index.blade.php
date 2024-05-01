@extends('layouts.user')

@section('title', 'Executive Search Page | ' . config('app.name'))
@section('content')
    @php($input_properties = request()->input('properties'))

    <div id="mainBlock" class="section-dashboard section-dashboard-search">
        <div class="section-dashboard-title flex flow-column">
            <h2>Executive Search Page</h2>
        </div>

        <div class="search-box">
            <div class="search-box-item">
                <label for="search" class="title neue-bold fz-016 dark">Search by Name/Company</label>
                <div class="a-input-search-box">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_243_15430)">
                            <path
                                d="M19.9998 18.8222L14.7815 13.6039C16.137 11.946 16.8035 9.83063 16.643 7.69519C16.4826 5.55974 15.5075 3.56766 13.9195 2.13098C12.3315 0.69431 10.252 -0.0770391 8.11119 -0.0235126C5.9704 0.030014 3.93207 0.90432 2.41783 2.41856C0.903588 3.9328 0.0292815 5.97113 -0.024245 8.11192C-0.0777715 10.2527 0.693577 12.3322 2.13025 13.9202C3.56693 15.5082 5.55901 16.4833 7.69445 16.6438C9.8299 16.8042 11.9453 16.1377 13.6032 14.7822L18.8215 20.0006L19.9998 18.8222ZM8.33315 15.0006C7.01461 15.0006 5.72568 14.6096 4.62935 13.877C3.53302 13.1445 2.67854 12.1033 2.17395 10.8851C1.66937 9.66693 1.53735 8.32649 1.79458 7.03328C2.05182 5.74008 2.68676 4.55219 3.61911 3.61984C4.55146 2.68749 5.73934 2.05255 7.03255 1.79532C8.32576 1.53808 9.6662 1.6701 10.8844 2.17469C12.1025 2.67927 13.1437 3.53375 13.8763 4.63008C14.6088 5.72641 14.9998 7.01534 14.9998 8.33389C14.9978 10.1014 14.2948 11.7959 13.045 13.0457C11.7952 14.2956 10.1007 14.9986 8.33315 15.0006Z"
                                fill="#919EAB"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_243_15430">
                                <rect width="20" height="20" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                    <input class="a-input-search mirror" data-name="query" type="search" name="query" id="search"
                           placeholder="Enter..." value="{{ request()->input('query') }}">
                </div>
                <div class="search-buttons flex align-center flex-between">
                    <a id="goToFilters" class="btn btn-border" href="javascript:;">
                        {{ request()->has('properties') ? 'Change Filters' : 'Apply Filters' }}</a>
                    <button class="btn btn-black" type="submit" form="filterForm">Search</button>
                </div>
            </div>

            @if(isset($filter_properties))
            <ul class="filters-list flex align-center">
                @foreach($filter_properties as $filter_property)
                <li class="filters-item flex align-center" data-items="{{ $filter_property->values_data_in_string }}" data-property="{{ $filter_property->property }}">
                    <span class="fw-bold fz-016 black">{{ $filter_property->property_title }}:</span>
                    <span class="fw-regular fz-016 black">{{ $filter_property->values_in_string }}</span>
                    <svg class="close" width="20" height="20" viewBox="0 0 20 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.5 6.5L6.5 13.5M6.5 6.5L13.5 13.5" stroke="#98A2B3" stroke-width="1.66667"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </li>
                @endforeach
            </ul>
            @endif

        </div>

        <div class="section-dashboard-content flex flow-column">
            <div class="content-item">
                <div class="leadership-list flex flow-column">
                    <div class="leadership-title-box flex flex-between align-center">
                        <div class="title neue-bold fz-016 dark">List of Executive Companies</div>
                        <div class="title neue-bold fz-016 dark">List of Executive Companies</div>
                    </div>
                    <div class="leadership-list-section-box">
                        <ul id="ul1" class="leadership-list-section first flex align-center flex-between">
                            @foreach($executives as $executive)
                                <li class="list-item">
                                    <a class="flex align-center show-executive" href="{{ route('user.search.show', $executive) }}">
                                        <div class="book-name">{{ $executive->full_name }}</div>
                                        <div class="book-author">{{ $executive->company }}</div>
                                        <span></span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.4144 10.5861L13.1213 6.29297L11.7072 7.70701L15.0003 11.0001H5V13.0002H15.0003L11.7072 16.2933L13.1213 17.7073L17.4144 13.4142C17.7894 13.0391 18 12.5305 18 12.0002C18 11.4698 17.7894 10.9612 17.4144 10.5861Z"
                                                fill="black"/>
                                        </svg>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="pagination-wrapper">
                            {{ $executives->withQueryString()->links() }}
                        </div>
                    </div>
                </div>

                @if($executives->isEmpty())
                <div class="empty empty-search fz-014 flex align-center justify-center">
                    No companies have found
                </div>
                @endif
            </div>
        </div>
    </div>

    <div id="filterBlock" class="section-dashboard section-dashboard-search btn-back-section" style="display:none;">
        <div class="section-dashboard-title flex flow-column">
            <h2>Filters</h2>
            <a id="goToMain" class="flex align-center fw-medium fz-016" href="javascript:;">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.02302 10.0006L13.1478 14.1253L11.9693 15.3038L6.66602 10.0006L11.9693 4.69727L13.1478 5.87577L9.02302 10.0006Z"
                        fill="black"/>
                </svg>
                Back
            </a>
        </div>


        <form id="filterForm" action="">
            <input type="hidden" name="query" value="{{ request()->input('query') }}">
        <div class="section-dashboard-content flex flow-column">
            <div class="content-item">
                <div class="filters-group flex">
                    @foreach($properties as $property)
                        @continue(!$property)
                        <div class="dropdown_with-chk">
                            <button class="dropdown_with-chk__button" type="button">{{ $property->title }}</button>
                            <ul class="dropdown_with-chk__list">
                                @foreach($property->values as $property_value)
                                <li class="dropdown_with-chk__list-item flex align-center @if(isset($property->name) && is_array(request()->input($property->name)) && in_array($property_value, request()->input($property->name))) dropdown_with-chk__list-item_active @endif">
                                    <input class="dropdown_with-chk__list-item_label" type="checkbox"
                                           name="{{ $property->name }}[]" value="{{ $property_value }}"
                                           id="property-{{ $property->name . '-' . $property_value }}" @checked(isset($property->name) && is_array(request()->input($property->name)) && in_array($property_value, request()->input($property->name)))>
                                    <label for="{{ $property_value }}" class="dropdown_with-chk__list-item_label">{{ $property_value }}</label>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                    @endforeach
                </div>
                <div class="filters-group-btn">
                    <button type="submit" class="btn btn-black ml-auto">Apply Filters</button>
                </div>
            </div>
        </div>
        </form>
    </div>

    <div id="showBlock" style="display:none;"></div>


@endsection


@push('scripts')
    <script src="{{ asset('js/executive-search.js') }}"></script>
@endpush
