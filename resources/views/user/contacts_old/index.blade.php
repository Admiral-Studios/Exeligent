@extends('layouts.user')

@section('title', 'Networking Plan | ' . config('app.name'))

@section('content')

    <div id="mainBlock" class="section-dashboard section-dashboard-networking">
        <div class="section-dashboard-title flex flex-between">
            <div class="flex flow-column">
                <h2>Networking Funnel</h2>
                <p class="inter fw-regular fz-012 dark">
                    Search for the contact that you have in your list, get detailed info, update it and keep for
                    the future situations.
                </p>
            </div>
        </div>


        @if($user_has_contacts)
            <div class="search-box flex align-center">
                <div class="search-buttons top flex align-center">
                    <a href="{{ route('user.contacts.export.xlsx') }}" class="btn btn-black" style="display: inline">Export
                        XLSX</a>
                    <a href="{{ route('user.contacts.export.csv') }}" class="btn btn-black" style="display: inline">Export
                        CSV</a>
                </div>
            </div>
        @endif


        <div class="search-box">
            <div class="search-buttons flex align-center">
                @if($all_contacts->isNotEmpty())
                    <a href="{{ route('user.contacts.index') }}" class="btn btn-black" type="submit"
                       style="margin: auto">Close all Contacts</a>
                @else
                    <a href="{{ route('user.contacts.index', ['all' => 'all']) }}" class="btn btn-black" type="submit"
                       style="margin: auto">See all Contacts</a>
                @endif
            </div>

            @if($all_contacts->isNotEmpty())
                <div class="section-dashboard-content flex flow-column">
                    <div class="content-item">
                        <div class="leadership-list networking flex flow-column">
                            <div class="leadership-title-box flex flex-between align-center">
                                <div class="title neue-bold fz-016 dark">Funnel</div>
                                <div class="title neue-bold fz-016 dark">Funnel</div>
                            </div>
                            <div class="leadership-list-section-box items-container">
                                @include('user.contacts._contacts', ['contacts' => $all_contacts])
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <div class="search-box">
            <form class="keep-tab" method="GET">
                <div class="search-box-wrapper">
                    <div class="search-box-item">
                        <label for="search_name" class="title neue-bold fz-016 dark">Search by Name</label>
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
                            <input class="a-input-search" type="search" name="search_name" id="search_name"
                                   placeholder="Enter name..." value="{{ request()->input('search_name') }}">
                        </div>
                    </div>
                    <div class="search-box-item">
                        <label for="search_company" class="title neue-bold fz-016 dark">Search by Company</label>
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
                            <input class="a-input-search" type="search" name="search_company" id="search_company"
                                   placeholder="Enter company..." value="{{ request()->input('search_company') }}">
                        </div>
                    </div>
                </div>
                <div class="search-box-wrapper">
                    <div class="search-box-item">
                        <label for="search_position" class="title neue-bold fz-016 dark">Search by Position</label>
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
                            <input class="a-input-search" type="search" name="search_position" id="search_position"
                                   placeholder="Enter position..." value="{{ request()->input('search_position') }}">
                        </div>
                    </div>
                    <div class="search-box-item">
                        <label for="search_type" class="title neue-bold fz-016 dark">Search by type</label>
                        <div class="dropdown">
                            <button
                                class="dropdown__button @if(request()->input('search_type')) select-active @endif @error('search_type') is-invalid @enderror"
                                type="button">{{ $types[request()->input('search_type')] ?? (request()->input('search_type') == 'none' ? 'None' : 'Choose type...') }}</button>
                            @error('search_type')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                            <ul class="dropdown__list">
                                <li class="dropdown__list-item" data-value="">All</li>
                                <li class="dropdown__list-item @if(request()->input('search_type') == 'none') dropdown__list-item_active @endif"
                                    data-value="none">None
                                </li>
                                @foreach($types as $id => $search_type)
                                    <li class="dropdown__list-item @if(request()->input('search_type') == $id) dropdown__list-item_active @endif"
                                        data-value="{{ $id }}">{{ $search_type }}</li>
                                @endforeach
                                <input class="dropdown__input_hidden" type="text" name="search_type"
                                       value="{{ request()->input('search_type') }}">
                            </ul>
                        </div>
                    </div>
                </div>
                {{--                    <div class="search-box-item">--}}
                {{--                        <label for="search_type" class="title neue-bold fz-016 dark">Search by status</label>--}}
                {{--                        <div class="dropdown">--}}
                {{--                            <button class="dropdown__button @if(request()->input('search_status')) select-active @endif @error('search_status') is-invalid @enderror" type="button">{{ $statuses[request()->input('search_status')] ?? (request()->input('search_status') == 'none' ? 'None' : 'Choose status...') }}</button>--}}
                {{--                            @error('search_status')--}}
                {{--                            <span class="invalid-feedback" role="alert">--}}
                {{--                                            <strong>{{ $message }}</strong>--}}
                {{--                                        </span>--}}
                {{--                            @enderror--}}
                {{--                            <ul class="dropdown__list">--}}
                {{--                                    <li class="dropdown__list-item" data-value="">All</li>--}}
                {{--                                    <li class="dropdown__list-item @if(request()->input('search_status') == 'none') dropdown__list-item_active @endif" data-value="none">None</li>--}}
                {{--                                @foreach($statuses as $id => $search_status)--}}
                {{--                                    <li class="dropdown__list-item @if(request()->input('search_status') == $id) dropdown__list-item_active @endif" data-value="{{ $id }}">{{ $search_status }}</li>--}}
                {{--                                @endforeach--}}
                {{--                                <input class="dropdown__input_hidden" type="text" name="search_status" value="{{ request()->input('search_status') }}">--}}
                {{--                            </ul>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                <div class="search-box-wrapper">
                    <div class="search-box-item">
                        <label for="since" class="title neue-bold fz-016 dark">Search by connection date</label>
                        <div class="a-input-search-box">
                            <input class="a-input-search date" type="search" name="search_connected" id="since"
                                   placeholder="Select date period..." autocomplete="off"
                                   value="{{ request()->input('search_connected') }}">
                        </div>
                    </div>
                    <div class="search-box-item">
                        <label for="search_type" class="title neue-bold fz-016 dark">Sort by</label>
                        <div class="dropdown">
                            <button
                                class="dropdown__button @if(request()->input('sort_by')) select-active @endif @error('sort_by') is-invalid @enderror"
                                type="button">{{ $sort_options[request()->input('sort_by')] ?? 'Default' }}</button>
                            @error('sort_by')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                            <ul class="dropdown__list">
                                <li class="dropdown__list-item" data-value="">Default</li>
                                @foreach($sort_options as $sort_name => $sort_title)
                                    <li class="dropdown__list-item @if(request()->input('sort_by') == $sort_name) dropdown__list-item_active @endif"
                                        data-value="{{ $sort_name }}">{{ $sort_title }}</li>
                                @endforeach
                                <input class="dropdown__input_hidden" type="text" name="sort_by"
                                       value="{{ request()->input('sort_by') }}">
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="search-buttons flex align-center flex-between">
                    <button class="btn btn-black ml-auto" type="submit">Search</button>
                </div>
            </form>

        </div>

        <div class="section-dashboard-content flex flow-column">
            <div class="content-item">
                <div id="funnelStatuses" class="networking-functional-buttons flex align-center">
                    <button class="networking-sort flex flow-column align-center tab-funnel active" data-funnel="tab1">
                        <span class="neue-medium fz-024">{{ $to_contact->total() }}</span>
                        <span class="neue-medium fz-016">Contacts</span>
                    </button>
                    <button class="networking-sort flex flow-column align-center tab-funnel" data-funnel="tab2">
                        <span class="neue-medium fz-024">{{ $no_follow->total() }}</span>
                        <span class="neue-medium fz-016">Contacted</span>
                    </button>
                    <button class="networking-sort flex flow-column align-center tab-funnel" data-funnel="tab3">
                        <span class="neue-medium fz-024">{{ $follow_up->total() }}</span>
                        <span class="neue-medium fz-016">To Follow Up</span>
                    </button>
                </div>

                <div class="tab-funnel-box tab-funnel-active" data-funnel="tab1">
                    <div class="leadership-list networking flex flow-column">
                        <div class="leadership-title-box flex flex-between align-center">
                            <div class="title neue-bold fz-016 dark">Funnel</div>
                            <div class="title neue-bold fz-016 dark">Funnel</div>
                        </div>
                        <div class="leadership-list-section-box items-container">
                            @include('user.contacts._contacts', ['contacts' => $to_contact, 'status' => \App\Models\Contact::STATUS_TO_CONTACT])
                        </div>
                    </div>

                    <div class="empty empty-search fz-014 flex align-center justify-center">
                        No funnel have found
                    </div>
                </div>

                <div class="tab-funnel-box tab-funnel-active" data-funnel="tab2">
                    <div class="leadership-list networking flex flow-column">
                        <div class="leadership-title-box flex flex-between align-center">
                            <div class="title neue-bold fz-016 dark">Funnel</div>
                            <div class="title neue-bold fz-016 dark">Funnel</div>
                        </div>
                        <div class="leadership-list-section-box items-container">
                            @include('user.contacts._contacts', ['contacts' => $no_follow, 'status' => \App\Models\Contact::STATUS_NO_FOLLOW_UP])
                        </div>
                    </div>

                    <div class="empty empty-search fz-014 flex align-center justify-center">
                        No funnel have found
                    </div>
                </div>

                <div class="tab-funnel-box tab-funnel-active" data-funnel="tab3">
                    <div class="leadership-list networking flex flow-column">
                        <div class="leadership-title-box flex flex-between align-center">
                            <div class="title neue-bold fz-016 dark">Funnel</div>
                            <div class="title neue-bold fz-016 dark">Funnel</div>
                        </div>
                        <div class="leadership-list-section-box items-container">
                            @include('user.contacts._contacts', ['contacts' => $follow_up, 'status' => \App\Models\Contact::STATUS_FOLLOW_UP])
                        </div>
                    </div>

                    <div class="empty empty-search fz-014 flex align-center justify-center">
                        No funnel have found
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="showBlock" style="display:none;"></div>

    <div id="editBlock" style="display:none;"></div>

@endsection

@push('scripts')
    <script src="{{ asset('js/contacts.js') }}"></script>
@endpush
