@extends('layouts.user')

@section('title', 'Networking Plan | ' . config('app.name'))

@section('content')

        <div class="section-dashboard section-dashboard-networking">
            <div class="section-dashboard-title flex flex-between">
                <div class="title-box flex flow-column">
                    <h2>Add Contact Opportunity</h2>
                    <p class="inter fw-regular fz-012 dark">
                        Easily add any new contact of the person you spoke to, keep track of this data, and get back
                        to
                        any
                        information with an option to edit.
                    </p>
                </div>
                <div class="a-progress-bar" data-form="add_contact_form">
                    <div class="a-progress-bar-percent inter fw-medium fz-012"><span class="count">0</span>% <span>done</span></div>
                    <div class="progress">
                        <div class="bar" style="width:0%"></div>
                    </div>
                </div>
            </div>

            <div class="section-dashboard-content flex flow-column">
                <div class="content-item">
                    <form id="add_contact_form" class="progress-tracking submit-disabled" action="{{ route('user.contacts.store') }}" method="POST">
                        @csrf
                        <div class="a-form__section">
                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label for="first_name" class="a-form__item__label">First Name</label>
                                    <input class="a-input a-input-brand @error('first_name') is-invalid @enderror"
                                           id="first_name" name="first_name" value="{{ old('first_name') }}" type="text"
                                           placeholder="Enter First name..." required/>
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="a-form__item-box">
                                    <label for="contact_method" class="a-form__item__label">Method of Contact</label>
                                    <input class="a-input a-input-brand @error('contact_method') is-invalid @enderror"
                                           id="contact_method" name="contact_method" value="{{ old('contact_method') }}" type="text"
                                           placeholder="Enter method of contact..."/>
                                    @error('contact_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label for="last_name" class="a-form__item__label">Last Name</label>
                                    <input class="a-input a-input-brand @error('last_name') is-invalid @enderror"
                                           id="last_name" name="last_name" value="{{ old('last_name') }}" type="text"
                                           placeholder="Enter Last name..." required/>
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="a-form__item-box">
                                    <label for="conversation_topic" class="a-form__item__label">Topic of
                                        Conversation</label>
                                    <input class="a-input a-input-brand addable @error('conversation_topic.0') is-invalid @enderror"
                                           id="conversation_topic" name="conversation_topic[]" value="{{ old('conversation_topic.0') }}" type="text"
                                           placeholder="Enter topic of conversation..."/>
                                    @error('conversation_topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    @if(old('conversation_topic'))
                                    @foreach(old('conversation_topic') as $topic)
                                        @continue($loop->first)
                                        <div class="multiple-input-deletable">
                                            <input class="a-input a-input-brand addable deletable" name="conversation_topic[]" value="{{ $topic }}"
                                                   type="text"
                                                   placeholder="Enter topic of conversation...">
                                            @error("conversation_topic.$loop->index")
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <span class="delete"></span>
                                        </div>
                                    @endforeach
                                    @endif

                                    <button type="button" class="a-form__item-box__add-more flex align-center add-input input-has-name no-need-new-index">
                                        Add New
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="black"/>
                                        </svg>
                                    </button>

                                    <template>
                                        <div class="multiple-input-deletable">
                                            <input class="a-input a-input-brand addable deletable" name="conversation_topic[]" value=""
                                                   type="text"
                                                   placeholder="Enter topic of conversation...">
                                            <span class="delete"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label for="company" class="a-form__item__label">Company Name</label>
                                    <input class="a-input a-input-brand @error('company') is-invalid @enderror"
                                           id="company" name="company" value="{{ old('company') }}" type="text"
                                           placeholder="Enter company name..."/>
                                    @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="a-form__item-box">
                                    <label for="advice_or_feedback" class="a-form__item__label">Specific Advice or Feedback
                                        Received</label>
                                    <input class="a-input a-input-brand addable @error('advice_or_feedback.0') is-invalid @enderror"
                                           id="advice_or_feedback" name="advice_or_feedback[]" value="{{ old('advice_or_feedback.0') }}" type="text"
                                           placeholder="Enter specific advice or feedback Received"/>
                                    @error('advice_or_feedback')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    @if(old('advice_or_feedback'))
                                    @foreach(old('advice_or_feedback') as $advice)
                                        @continue($loop->first)
                                        <div class="multiple-input-deletable">
                                            <input class="a-input a-input-brand addable deletable" name="conversation_topic[]" value="{{ $advice }}"
                                                   type="text"
                                                   placeholder="Enter topic of conversation...">
                                            @error("conversation_topic.$loop->index")
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <span class="delete"></span>
                                        </div>
                                    @endforeach
                                    @endif

                                    <button type="button" class="a-form__item-box__add-more flex align-center add-input input-has-name no-need-new-index">
                                        Add New
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="black"/>
                                        </svg>
                                    </button>

                                    <template>
                                        <div class="multiple-input-deletable">
                                            <input class="a-input a-input-brand addable deletable" name="advice_or_feedback[]" value=""
                                                   type="text"
                                                   placeholder="Enter specific advice or feedback Received...">
                                            <span class="delete"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label for="position" class="a-form__item__label">Position</label>
                                    <input class="a-input a-input-brand @error('position') is-invalid @enderror"
                                           id="position" name="position" value="{{ old('position') }}" type="text"
                                           placeholder="Enter position..."/>
                                    @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="a-form__item-box">
                                    <label for="interests_or_hobbies" class="a-form__item__label">Interests or Hobbies</label>
                                    <input class="a-input a-input-brand addable @error('interests_or_hobbies.0') is-invalid @enderror"
                                           id="interests_or_hobbies" name="interests_or_hobbies[]" value="{{ old('interests_or_hobbies.0') }}" type="text"
                                           placeholder="Enter interests or hobbies..."/>
                                    @error('interests_or_hobbies')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror


                                    @if(old('interests_or_hobbies'))
                                    @foreach(old('interests_or_hobbies') as $interest)
                                        @continue($loop->first)
                                        <div class="multiple-input-deletable">
                                            <input class="a-input a-input-brand addable deletable" name="conversation_topic[]" value="{{ $interest }}"
                                                   type="text"
                                                   placeholder="Enter topic of conversation...">
                                            @error("conversation_topic.$loop->index")
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <span class="delete"></span>
                                        </div>
                                    @endforeach
                                    @endif

                                    <button type="button" class="a-form__item-box__add-more flex align-center add-input input-has-name no-need-new-index">
                                        Add New
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="black"/>
                                        </svg>
                                    </button>

                                    <template>
                                        <div class="multiple-input-deletable">
                                            <input class="a-input a-input-brand addable deletable" name="interests_or_hobbies[]" value=""
                                                   type="text"
                                                   placeholder="Enter interests or hobbies...">
                                            <span class="delete"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label for="mutual_connection" class="a-form__item__label">Mutual Connection</label>
                                    <input class="a-input a-input-brand @error('mutual_connection') is-invalid @enderror"
                                           id="mutual_connection" name="mutual_connection" value="{{ old('mutual_connection') }}" type="text"
                                           placeholder="Enter mutual connection..."/>
                                    @error('mutual_connection')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="a-form__item-box">
                                    <label class="a-form__item__label">Status</label>
                                    <div class="dropdown">
                                        <button class="dropdown__button @if(old('status')) select-active @endif @error('status') is-invalid @enderror" type="button">{{ \App\Models\Contact::ALL_STATUSES[old('status')] ?? 'Choose status...' }}</button>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <ul class="dropdown__list">
                                            @foreach($statuses as $id => $status)
                                                <li class="dropdown__list-item @if(old('status') == $id) dropdown__list-item_active @endif" data-value="{{ $id }}">{{ $status }}</li>
                                            @endforeach
                                            <input class="dropdown__input_hidden" type="text" name="status" value="{{ old('status') }}">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label">Type</label>
                                    <div class="dropdown">
                                        <button class="dropdown__button @if(old('type')) select-active @endif @error('type') is-invalid @enderror" type="button">{{ \App\Models\Contact::ALL_TYPES[old('type')] ?? 'Choose type...' }}</button>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <ul class="dropdown__list">
                                            @foreach($types as $id => $type)
                                                <li class="dropdown__list-item @if(old('type') == $id) dropdown__list-item_active @endif" data-value="{{ $id }}">{{ $type }}</li>
                                            @endforeach
                                            <input class="dropdown__input_hidden" type="text" name="type" value="{{ old('type') }}">
                                        </ul>
                                    </div>
                                </div>
                                <div class="a-form__item-box">
                                </div>
                            </div>
                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label for="contacted_at" class="a-form__item__label">Date Contacted</label>
                                    {{--                                    <input class="a-input a-input-brand @error('contacted_at') is-invalid @enderror"--}}
                                    {{--                                           id="contacted_at" name="contacted_at" value="" type="text"--}}
                                    {{--                                           placeholder="Enter mutual connection..."/>--}}
                                    <input class="a-input a-input-brand @error('contacted_at') is-invalid @enderror"
                                           type="date" data-date="" data-date-format="DD MMMM YYYY"
                                           id="contacted_at" name="contacted_at" value="{{ old('contacted_at') }}"
                                           placeholder="Enter mutual connection...">
                                    @error('contacted_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="a-form__item-box">
                                </div>
                            </div>
                            <div class="a-form__item">
                                <div class="a-form__item-box">
                                    <label class="a-form__item__label" for="contact_details_phone">Contact Details</label>
                                    <input class="a-input a-input-brand @error('contact_details.phone') is-invalid @enderror"
                                           id="contact_details_phone" name="contact_details[phone]" value="{{ old('contact_details.phone') }}" type="text"
                                           placeholder="Enter mobile..."/>
                                    @error('contact_details.phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <input class="a-input a-input-brand @error('contact_details.email') is-invalid @enderror"
                                           id="contact_details_email" name="contact_details[email]" value="{{ old('contact_details.email') }}" type="email"
                                           placeholder="Enter email..."/>
                                    @error('contact_details.email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    @if(old('contact_details'))
                                        @foreach(old('contact_details') as $i => $contact_detail)
                                            @continue($i == 'email' || $i == 'phone')
                                            <div class="multiple-input-deletable">
                                                <input class="a-input a-input-brand  @error('contact_details.'.$i) is-invalid @enderror deletable" name="contact_details[{{ $i }}]" value="{{ $contact_detail }}" type="text" placeholder="Enter...">
                                                @error('contact_details.'.$i)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                /images/select-option-check.svg
                                            </div>
                                        @endforeach
                                    @endif
                                    <button type="button" data-name="contact_details"
                                            class="a-form__item-box__add-more flex align-center add-input">
                                        Add New Contact Details
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z" fill="black"/>
                                        </svg>
                                    </button>
                                    <template>
                                        <div class="multiple-input-deletable">
                                            <input class="a-input a-input-brand deletable" name="" value="" type="text" placeholder="Enter...">
                                            <span class="delete"></span>
                                        </div>
                                    </template>
                                </div>
                                <div class="a-form__item-box">
                                </div>
                            </div>
                        </div>
                        <div class="button-section flex align-center">
                            <button class="btn btn-black" type="submit" disabled>Add Contact</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/contacts.js') }}"></script>
@endpush
