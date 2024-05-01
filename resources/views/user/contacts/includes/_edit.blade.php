<div class="section-dashboard contact-edit ">
    <div class="section-dashboard-title flex flex-between">
        <h2 class="flex align-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none" class="close-contact">
                <path d="M11.4375 19.25L4.6875 12.5L11.4375 5.75M5.625 12.5H19.3125" stroke="black"
                      stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            {{ $contact->full_name }}
        </h2>

        <button type="submit" form="editNetworkingContact" class="btn btn-blue btn-desktop">
            Save
        </button>
    </div>
    <div class="section-dashboard-content">
        <form id="editNetworkingContact" class="a-form" action="{{ route('user.contacts.update', $contact) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="a-form__section">
                <div class="a-form__item relationships flex">
                    <div class="a-form__item-box">
                        <label class="a-form__item__label" for="">`Relationships</label>
                        <ul class="choose-block-list">
                            @foreach(\App\Enums\ContactRelationshipEnum::cases() as $case)
                                <li class="choose-block @if(old('relationship', $contact->relationship) == $case->value) active @endif">
                                    <input type="radio" name="relationship" value="{{ $case->value }}" @checked(old('relationship', $contact->relationship) == $case->value)>
                                    {{ $case->getTitle() }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="a-form__item-box">
                        <label class="a-form__item__label" for="">Last Contact Date</label>
                        <div class="a-input-datepicker">
                            <input type="date" value="{{ old('contacted_at', $contact->simple_contacted_at) }}"
                                   name="contacted_at" class="a-input @error('contacted_at') is-invalid @enderror" id="date" aria-required="true"
                                   aria-invalid="false" placeholder="{{ old('contacted_at', $contact->pretty_contacted_at ?? 'DD/MM/YYYY') }}"
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
                                <li class="choose-block @if(old('status', $contact->status) == $case->value) active @endif">
                                    <input type="radio" name="status" value="{{ $case->value }}" @checked(old('status', $contact->status) == $case->value)>
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
                                <li class="choose-block @if(old('goal', $contact->goal) == $case->value) active @endif">
                                    <input type="radio" name="goal" value="{{ $case->value }}" @checked(old('goal', $contact->goal) == $case->value)>
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
                        <textarea class="a-input a-input-textarea @error('notes') is-invalid @enderror" name="notes" id="" placeholder="Type here">{{ old('notes', $contact->notes) }}</textarea>
                        @error('notes')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="decor-border"></div>

                <div class="a-form__item flex">
                    <div class="a-form__item-box">
                        <label class="a-form__item__label" for="">First Name</label>
                        <input class="a-input @error('first_name') is-invalid @enderror" type="text" placeholder="Type..." id="" name="first_name" value="{{ old('first_name', $contact->first_name) }}" required>
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="a-form__item-box">
                        <label class="a-form__item__label" for="">Last Name</label>
                        <input class="a-input" type="text" placeholder="Type..." id="" name="last_name"  value="{{ old('last_name', $contact->last_name) }}" required>
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
                        <input class="a-input @error('company') is-invalid @enderror" type="text" placeholder="Type..." id="" name="company" value="{{ old('company', $contact->company) }}">
                        @error('company')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="a-form__item-box">
                        <label class="a-form__item__label" for="">Role</label>
                        <input class="a-input @error('position') is-invalid @enderror" type="text" placeholder="Type..." id="" name="position" value="{{ old('position', $contact->position) }}">
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
                        <input class="a-input @error('contact_method') is-invalid @enderror" type="text" placeholder="Type..." id="" name="contact_method" value="{{ old('contact_method', $contact->contact_method) }}">
                        @error('contact_method')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="a-form__item-box">
                        <label class="a-form__item__label" for="">Location</label>
                        <div class="a-input-location">
                            <input class="a-input search-location @error('location') is-invalid @enderror" type="text" placeholder="Select" id="" data-only="City,State" name="location" value="{{ old('location', $contact->location) }}">
                            @error('location')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form id="deleteContactForm" method="POST" action="{{ route('user.contacts.destroy', $contact) }}">
            @csrf
            @method('DELETE')
        <div class="section-delete">
            <div class="title">Delete Account</div>
            <button type="button" id="btnDeleteAccount">
                Delete Contact and data
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M5.96655 2.71978L10.3132 7.06645C10.8266 7.57979 10.8266 8.41978 10.3132 8.93312L5.96655 13.2798" stroke="#AAB3BC" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        </form>

        <div class="btn-mobile">
            <button class="btn btn-blue">
                Save
            </button>
        </div>
    </div>
</div>
