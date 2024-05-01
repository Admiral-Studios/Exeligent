@extends("layouts.user")

@section('title', 'Networking')
@section('body-class', 'networking-new-part')

@section('content')

    <div id="mainBlock">
        <div class="tab-menu">
            <ul class="tab-menu-list flex">
                <li><a href="#" class="tab-a active-a" data-id="tab1">Networking Funnel</a></li>
                <li><a href="#" class="tab-a" data-id="tab2">Contacts</a></li>
                <li><a href="#" class="tab-a" data-id="tab3">Networking Preparation</a></li>
                <li class="story">
                    <a href="#" class="tab-a" data-id="tab4">
                        Add Contact Opportunity
                    </a>
                </li>
            </ul>
        </div>

        <div class="tab tab-active tab-dashboard" data-id="tab1">
            <div class="section-dashboard">
                <div class="section-dashboard-title border-none flex flex-between">
                    <h2>Networking Funnel</h2>

                    @if($is_user_has_any_contacts)
                    <div class="buttons-download">
                        <a href="{{ route('user.contacts.export.xlsx') }}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.55999 8.89844C3.95999 9.20844 2.48999 11.0584 2.48999 15.1084V15.2384C2.48999 19.7084 4.27999 21.4984 8.74999 21.4984H15.27C19.74 21.4984 21.53 19.7084 21.53 15.2384V15.1084C21.53 11.0884 20.08 9.23844 16.54 8.90844"
                                    stroke="#027FFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 15.0011V3.62109" stroke="#027FFE" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M8.6499 5.85L11.9999 2.5L15.3499 5.85" stroke="#027FFE" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Export XLSX
                        </a>
                        <a href="{{ route('user.contacts.export.csv') }}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.55999 8.89844C3.95999 9.20844 2.48999 11.0584 2.48999 15.1084V15.2384C2.48999 19.7084 4.27999 21.4984 8.74999 21.4984H15.27C19.74 21.4984 21.53 19.7084 21.53 15.2384V15.1084C21.53 11.0884 20.08 9.23844 16.54 8.90844"
                                    stroke="#027FFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 15.0011V3.62109" stroke="#027FFE" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M8.6499 5.85L11.9999 2.5L15.3499 5.85" stroke="#027FFE" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Export CSV
                        </a>
                    </div>
                    @endif
                </div>
                <div class="section-dashboard-content">

                    @if($is_user_has_any_contacts)
                    <div class="e-table-filters">
                        <div class="e-table-filters__item funnel-filter-status @if(!request(\App\Services\NetworkingService::FUNNEL_PREFIX . 'status')) active @endif" data-name="{{ \App\Services\NetworkingService::FUNNEL_PREFIX . 'status' }}" data-value="">
                            <span>{{ $funnel_counts['all'] }}</span>
                            All contacts
                        </div>
                        @foreach(\App\Enums\ContactStatusEnum::cases() as $case)
                            <div class="e-table-filters__item funnel-filter-status @if(request(\App\Services\NetworkingService::FUNNEL_PREFIX . 'status') == $case->value) active @endif" data-name="{{ \App\Services\NetworkingService::FUNNEL_PREFIX . 'status' }}" data-value="{{ $case->value }}">
                                <span>{{ $funnel_counts[$case->value] }}</span>
                                {{ $case->getTitle() }}
                            </div>
                        @endforeach
                    </div>

                        <form id="filterFunnelForm">
                            <input type="hidden" name="{{ \App\Services\NetworkingService::FUNNEL_PREFIX . 'status'  }}" value="{{ request(\App\Services\NetworkingService::FUNNEL_PREFIX . 'status') }}">
                    <div class="e-table-search">
                        <div class="a-input-search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path
                                    d="M7.29313 1.28906C3.98732 1.28906 1.29443 3.98194 1.29443 7.28777C1.29443 10.5936 3.98732 13.2917 7.29313 13.2917C8.70514 13.2917 10.0038 12.7969 11.0301 11.9753L13.5288 14.4727C13.6549 14.5935 13.8233 14.6602 13.998 14.6584C14.1727 14.6566 14.3397 14.5865 14.4633 14.4631C14.5869 14.3397 14.6572 14.1728 14.6592 13.9981C14.6613 13.8235 14.5948 13.655 14.4741 13.5287L11.9754 11.03C12.7977 10.0021 13.2931 8.70141 13.2931 7.28777C13.2931 3.98194 10.5989 1.28906 7.29313 1.28906ZM7.29313 2.62242C9.87836 2.62242 11.9585 4.70255 11.9585 7.28777C11.9585 9.87299 9.87836 11.9584 7.29313 11.9584C4.70791 11.9584 2.62777 9.87299 2.62777 7.28777C2.62777 4.70255 4.70791 2.62242 7.29313 2.62242Z"
                                    fill="#8599AD"/>
                            </svg>
                            <input class="a-input" type="search" name="{{ \App\Services\NetworkingService::FUNNEL_PREFIX . 'search' }}" placeholder="Search" value="{{ request(\App\Services\NetworkingService::FUNNEL_PREFIX . 'search') }}">
                        </div>

                        <div class="a-options">
                            <div class="a-option roles">
                                <select name="{{ \App\Services\NetworkingService::FUNNEL_PREFIX . 'role' }}">
                                    <option value="" @checked(!request(\App\Services\NetworkingService::FUNNEL_PREFIX . 'role'))>All</option>
                                    @foreach($filters['funnel']['roles'] as $value => $title)
                                        <option value="{{ $value }}" @checked(request(\App\Services\NetworkingService::FUNNEL_PREFIX . 'role') == $value)>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="a-option goals-option">
                                <select name="{{ \App\Services\NetworkingService::FUNNEL_PREFIX . 'goal' }}">
                                    <option value="" @checked(!request(\App\Services\NetworkingService::FUNNEL_PREFIX . 'goal'))>All</option>
                                    @foreach($filters['funnel']['goals'] as $value => $title)
                                        <option value="{{ $value }}" @checked(request(\App\Services\NetworkingService::FUNNEL_PREFIX . 'goal') == $value)>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="a-option sort-by">
                                <select name="{{ \App\Services\NetworkingService::FUNNEL_PREFIX . 'sort' }}">
                                    <option value="" @checked(!request(\App\Services\NetworkingService::FUNNEL_PREFIX . 'sort'))>Default</option>
                                    @foreach($filters['funnel']['sort'] as $value => $title)
                                        <option value="{{ $value }}" @checked(request(\App\Services\NetworkingService::FUNNEL_PREFIX . 'sort') == $value)>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                        </form>

                    <div class="e-mobile-table">
                        <table class="e-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Role</th>
                                <th>Goal</th>
                                <th>Last Contact Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($funnel as $funnelContact)
                                <tr>
                                    <td>{{ $funnelContact->full_name }}</td>
                                    <td>{{ $funnelContact->company }}</td>
                                    <td>{{ $funnelContact->position }}</td>
                                    <td>{{ $funnelContact->goal_title }}</td>
                                    <td>{{ $funnelContact->iso_contacted_at }}</td>
                                    <td>
                                        @if($funnelContact->status)
                                        <span class="{{ $funnelContact->status_class }}">{{ $funnelContact->status_title }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                        {{ $funnel->links('vendor.pagination.default') }}

                    @else

                    <div class="empty-section">
                        <h2>Let’s get started!</h2>
                        <div class="description">
                            Let’s Sync LinkedIn Connections first, which will import majority of your contacts, that we recommend manually add the rest of contacts.
                        </div>
                        <div class="buttons">
                            <a class="btn btn-blue-clear" href="javascript:void(0);" id="btnOpenLinkedInFunnel">Sync Linkedin Connections</a>
                            <a class="btn btn-blue-clear tab-a" href="#" data-id="tab4">Add Contact Opportunity</a>
                        </div>
                    </div>

                    @endif

                </div>
            </div>
        </div>

        <div class="tab tab-active tab-dashboard funnel-contacts" data-id="tab2">
            <div class="section-dashboard">
                <div class="section-dashboard-title border-none flex flex-between">
                    <h2>
                        Contacts
                        <div class="contacts-title">
                            {{ $contacts->total() }}
                            <span>Contacts</span>
                        </div>
                    </h2>
                    <div class="buttons-download">
                        <a href="javascript:void(0)" id="btnOpenLinkedIn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M7.56023 15.1016C3.96023 14.7916 2.49023 12.9416 2.49023 8.89156V8.76156C2.49023 4.29156 4.28023 2.50156 8.75023 2.50156H15.2702C19.7402 2.50156 21.5302 4.29156 21.5302 8.76156V8.89156C21.5302 12.9116 20.0802 14.7616 16.5402 15.0916"
                                    stroke="#027FFE" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 8.99891V20.3789" stroke="#027FFE" stroke-width="1.5" stroke-linecap="round"
                                      stroke-linejoin="round"/>
                                <path d="M8.65039 18.15L12.0004 21.5L15.3504 18.15" stroke="#027FFE" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Sync LinkedIn Connections
                        </a>
                    </div>
                </div>
                <div class="section-dashboard-content">

                    @if($is_user_has_any_contacts)

                        <form id="filterContactsForm">
                        <div class="e-table-search">
                            <div class="a-input-search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path
                                        d="M7.29313 1.28906C3.98732 1.28906 1.29443 3.98194 1.29443 7.28777C1.29443 10.5936 3.98732 13.2917 7.29313 13.2917C8.70514 13.2917 10.0038 12.7969 11.0301 11.9753L13.5288 14.4727C13.6549 14.5935 13.8233 14.6602 13.998 14.6584C14.1727 14.6566 14.3397 14.5865 14.4633 14.4631C14.5869 14.3397 14.6572 14.1728 14.6592 13.9981C14.6613 13.8235 14.5948 13.655 14.4741 13.5287L11.9754 11.03C12.7977 10.0021 13.2931 8.70141 13.2931 7.28777C13.2931 3.98194 10.5989 1.28906 7.29313 1.28906ZM7.29313 2.62242C9.87836 2.62242 11.9585 4.70255 11.9585 7.28777C11.9585 9.87299 9.87836 11.9584 7.29313 11.9584C4.70791 11.9584 2.62777 9.87299 2.62777 7.28777C2.62777 4.70255 4.70791 2.62242 7.29313 2.62242Z"
                                        fill="#8599AD"/>
                                </svg>
                                <input class="a-input" type="search" name="{{ \App\Services\NetworkingService::CONTACTS_PREFIX . 'search' }}" placeholder="Search" value="{{ request(\App\Services\NetworkingService::CONTACTS_PREFIX . 'search') }}">
                            </div>

                            <div class="a-options">
                                <div class="a-option locations">
                                    <select name="{{ \App\Services\NetworkingService::CONTACTS_PREFIX . 'location' }}">
                                        <option value="" @checked(!request(\App\Services\NetworkingService::CONTACTS_PREFIX . 'location'))>All</option>
                                        @foreach($filters['contacts']['locations'] as $value => $title)
                                            <option value="{{ $value }}" @checked(request(\App\Services\NetworkingService::CONTACTS_PREFIX . 'location') == $value)>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="a-option sort-by" style="">
                                    <select name="{{ \App\Services\NetworkingService::CONTACTS_PREFIX . 'sort' }}">
                                        <option value="" @checked(!request(\App\Services\NetworkingService::CONTACTS_PREFIX . 'sort'))>Default</option>
                                        @foreach($filters['contacts']['sort'] as $value => $title)
                                            <option value="{{ $value }}" @checked(request(\App\Services\NetworkingService::CONTACTS_PREFIX . 'sort') == $value)>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        </form>

                    <div class="e-mobile-table">
                        <table class="e-table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Company and role</th>
                                <th>Location</th>
                                <th>Contact Info</th>
                                <th>Relationships</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->full_name }}</td>
                                    <td>{{ $contact->company_and_position }}</td>
                                    <td>{{ $contact->location }}</td>
                                    <td>{{ $contact->contact_method }}</td>
                                    <td>
                                        <div>
                                            {{ $contact->relationship_title }}
                                            <a class="edit-contact" href="{{ route('user.contacts.edit', $contact) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24"
                                                     viewBox="0 0 18 24"
                                                     fill="none">
                                                    <g clip-path="url(#clip0_729_18947)">
                                                        <path
                                                            d="M17.8419 11.6139L12.3875 6.15942C12.1916 5.93062 11.8472 5.90395 11.6184 6.09993C11.3897 6.29587 11.363 6.64021 11.559 6.869C11.5772 6.89033 11.5971 6.91025 11.6184 6.92848L16.1402 11.4557H1.00049C0.699275 11.4557 0.45506 11.6999 0.45506 12.0012C0.45506 12.3024 0.699275 12.5466 1.00049 12.5466H16.1402L11.6184 17.0683C11.3897 17.2642 11.363 17.6086 11.559 17.8374C11.7549 18.0662 12.0992 18.0928 12.328 17.8969C12.3494 17.8786 12.3693 17.8587 12.3875 17.8374L17.842 12.3829C18.0534 12.1702 18.0534 11.8266 17.8419 11.6139Z"
                                                            fill="#1F7CEC"/>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_729_18947">
                                                            <rect width="18" height="24" fill="white"/>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                        {{ $contacts->links('vendor.pagination.default') }}

                    @else

                    <div class="empty-section">
                        <h2>No Contacts Yet</h2>
                        <div class="description">
                            To start work you need to add contacts.<br>
                            Add Contact Opportunity or Sync LinkedIn Connections.
                        </div>
                        <div class="buttons">
                            <a class="btn btn-blue-clear" href="javascript:void(0);" id="btnOpenLinkedInContacts">Sync Linkedin Connections</a>
                            <a class="btn btn-blue-clear tab-a" href="#" data-id="tab4">Add Contact Opportunity</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="tab tab-active tab-dashboard networking" data-id="tab3">
            <div class="section-dashboard">
                <div class="section-dashboard-title">
                    <h2>Networking Preparation</h2>
                </div>
                <div class="section-dashboard-content">

                    <form class="a-form" action="{{ route('user.networking.user-preparation.store') }}" method="POST">
                        @csrf
                        <div class="a-form__section">
                            <div class="a-form__item flex">
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label" for="">My Networking Goals</label>
                                    <span
                                        class="bottom-label">Have a clear goal, that you share during conversations.</span>
                                    @forelse($user_networking_preparation->goals as $goal)
                                        @if($loop->first || $loop->iteration == 2)
                                        <input class="a-input" type="text" placeholder="Type..." name="goals[]" value="{{ $goal }}" id="">
                                        @else
                                            <div class="multiple-input-deletable">
                                                <input class="a-input a-input-brand deletable" name="goals[]" value="{{ $goal }}" type="text"
                                                       placeholder="Type...">
                                                <span class="delete"></span>
                                            </div>
                                        @endif
                                    @empty
                                        <input class="a-input" type="text" placeholder="Type..." name="goals[]" id="">
                                        <input class="a-input" type="text" placeholder="Type..." name="goals[]" id="">
                                    @endforelse
                                    <button type="button"
                                            class="a-form__item-box__add-more flex align-center add-input no-need-new-index input-has-name">
                                        + Add More
                                    </button>
                                    <template>
                                        <div class="multiple-input-deletable">
                                            <input class="a-input a-input-brand deletable" name="goals[]" value="" type="text"
                                                   placeholder="Type...">
                                            <span class="delete"></span>
                                        </div>
                                    </template>
                                </div>
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label" for="">What Can I Help With</label>
                                    <span class="bottom-label">Make a list with things that you can help your network out with.</span>
                                    @forelse($user_networking_preparation->helps as $help)
                                        @if($loop->first || $loop->iteration == 2)
                                        <input class="a-input" type="text" placeholder="Type..." name="helps[]" value="{{ $help }}" id="">
                                        @else
                                            <div class="multiple-input-deletable">
                                                <input class="a-input a-input-brand deletable" name="helps[]" value="{{ $help }}" type="text"
                                                       placeholder="Type...">
                                                <span class="delete"></span>
                                            </div>
                                        @endif
                                    @empty
                                        <input class="a-input" type="text" placeholder="Type..." name="helps[]" id="">
                                        <input class="a-input" type="text" placeholder="Type..." name="helps[]" id="">
                                    @endforelse
                                    <button type="button"
                                            class="a-form__item-box__add-more flex align-center add-input no-need-new-index input-has-name">
                                        + Add More
                                    </button>
                                    <template>
                                        <div class="multiple-input-deletable">
                                            <input class="a-input a-input-brand deletable" name="helps[]" value="" type="text"
                                                   placeholder="Type...">
                                            <span class="delete"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="btn-bottom" style="margin-top: 38px;">
                            <button class="btn btn-black ml-auto" type="submit">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="tab tab-active tab-dashboard opportunity" data-id="tab4">
        <div class="section-dashboard">
            <div class="section-dashboard-title flex flex-between">
                <h2>Add Contact Opportunity</h2>
                <button type="submit" form="addContactForm" class="btn btn-blue">Save</button>
            </div>
            <div class="section-dashboard-content">
                <form id="addContactForm" class="a-form" action="{{ route('user.contacts.store') }}" method="POST">
                    @csrf
                    <div class="a-form__section">
                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="">First Name</label>
                                <input class="a-input @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Type..." id="" required>
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="">Last Name</label>
                                <input class="a-input @error('last_name') is-invalid @enderror" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Type..." id="" required>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="">Company</label>
                                <input class="a-input @error('company') is-invalid @enderror" type="text" name="company" value="{{ old('company') }}" placeholder="Type..." id="">
                                @error('company')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="">Role</label>
                                <input class="a-input @error('position') is-invalid @enderror" type="text" name="position" value="{{ old('position') }}" placeholder="Type..." id="">
                                @error('position')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="">Method of Contact</label>
                                <input class="a-input @error('contact_method') is-invalid @enderror" type="text" name="contact_method" value="{{ old('contact_method') }}" placeholder="Type..." id="">
                                @error('contact_method')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="">Location</label>
                                <div class="a-input-location">

                                    {{--Ветал, засунь сюда для локаций Select 2 как в май профайл--}}
                                    {{-- харашо, засунув --}}

                                    <input class="a-input search-location @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" type="text" data-only="City,State" placeholder="Select" id="">
                                    @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="a-form__item relationships flex">
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="">`Relationships</label>
                                <ul class="choose-block-list">
                                    @foreach(\App\Enums\ContactRelationshipEnum::cases() as $case)
                                        <li class="choose-block @if(old('relationship') == $case->value) active @endif">
                                            <input type="radio" name="relationship" value="{{ $case->value }}" @checked(old('relationship') == $case->value)>
                                            {{ $case->getTitle() }}
                                        </li>
                                    @endforeach
                                </ul>
                                @error('relationship')
                                <span class="invalid-feedback" role="alert" style="display: block!important">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="">Last Contact Date</label>
                                <div class="a-input-datepicker">
                                    <input type="date" value="{{ old('contacted_at') }}"
                                           class="a-input @error('contacted_at') is-invalid @enderror"
                                           id="date" name="contacted_at" aria-required="true"
                                           aria-invalid="false" placeholder="DD/MM/YYYY"
                                           onchange="this.className=(this.value!=''?'a-input has-value':'')">
                                    @error('contacted_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="decor-border"></div>

                        <div class="a-form__item status flex">
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="">Status</label>
                                <ul class="choose-block-list rounded">
                                    @foreach(\App\Enums\ContactStatusEnum::cases() as $case)
                                        <li class="choose-block @if(old('status') == $case->value) active @endif">
                                            <input type="radio" name="status" value="{{ $case->value }}" @checked(old('status') == $case->value)>
                                            {{ $case->getTitle() }}
                                        </li>
                                    @endforeach
                                </ul>
                                @error('status')
                                <span class="invalid-feedback" role="alert" style="display: block!important">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="">Goal of Contact</label>
                                <ul class="choose-block-list">
                                    @foreach(\App\Enums\ContactGoalEnum::cases() as $case)
                                        <li class="choose-block @if(old('goal') == $case->value) active @endif">
                                            <input type="radio" name="goal" value="{{ $case->value }}" @checked(old('goal') == $case->value)>
                                            {{ $case->getTitle() }}
                                        </li>
                                    @endforeach
                                </ul>
                                @error('goal')
                                <span class="invalid-feedback" role="alert" style="display: block!important">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="decor-border"></div>

                        <div class="a-form__item flex">
                            <div class="a-form__item-box">
                                <label class="a-form__item__label" for="">Notes</label>
                                <textarea class="a-input a-input-textarea @error('notes') is-invalid @enderror" name="notes" id=""
                                          placeholder="Type here">{{ old('notes') }}</textarea>
                                @error('notes')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>

    <div id="editBlock" style="display:none;">
    </div>

    <div class="a-modal linkedin-modal" id="modalLinkedIn">
        <div class="a-modal__wrapper" style="opacity: 1; visibility: visible;">
            <form action="{{ route('user.contacts.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="a-modal__header">
                <div class="title">Sync LinkedIn Connections</div>
            </div>
            <div class="a-modal__content">
                <ol class="linkedin-list">
                    <li>Click the <span>Me icon</span> at the top of your LinkedIn homepage.</li>
                    <li>Select <span>Settings & Privacy</span> from the dropdown.</li>
                    <li>Click <span>Data privacy</span> on the left pane.</li>
                    <li>Under the How LinkedIn uses your data section, click <span>Get a copy of your data</span>.</li>
                    <li>Select <span>Want something in particular?</span> Select the data files you’re most interested
                        in.
                    </li>
                    <li>Select <span>Connections</span>.</li>
                    <li>Click <span>Request archive</span>.</li>
                    <li>Enter your password and click <span>Done</span>.</li>
                    <li>You'll receive an email to your Primary Email address which will include a link where you can
                        download your list of connections.
                    </li>
                </ol>

                <div class="file-download flex">
                    <input class="@error('import_connections') is-invalid @enderror" type="file" id="file-input"
                           style="display:none;"
                           accept=".xls, .csv" name="import_connections">
                    @error('import_connections')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="button" class="btn btn-blue-clear" onclick="document.getElementById('file-input').click();">Select
                        File
                    </button>
                    <div id="file-info" class="file-info"></div>
                </div>

            </div>
            <div class="a-modal__footer">
                <button type="button" class="button-clear modal-close">Cancel</button>
                <button type="submit" class="button-blue" disabled id="importConnections">Import Connections</button>
            </div>
            </form>
        </div>
    </div>

    <div class="a-modal delete-modal" id="modalDeleteAccount">
        <div class="a-modal__wrapper">
            <div class="a-modal__header">
                <div class="title">Delete account</div>
                <div class="description">
                    Are you sure, that you want to delete? it can not be undone.
                </div>
            </div>
            <div class="a-modal__footer">
                <button type="button" class="button-clear modal-close delete">Cancel</button>
                <button type="submit" class="button-blue delete" form="deleteContactForm">Yes, delete</button>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('/js/networking-funnel.js') }}"></script>
@endpush
