<div class="section-dashboard section-dashboard-networking btn-back-section">
    <div class="section-dashboard-title flex flow-column">
        <div class="flex flow-column">
            <h2>Edit Contact Opportunity</h2>
        </div>
        <a class="flex align-center fw-medium fz-016 show-contact" href="{{ route('user.contacts.show', ['contact' => $contact->id]) }}">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.02302 10.0006L13.1478 14.1253L11.9693 15.3038L6.66602 10.0006L11.9693 4.69727L13.1478 5.87577L9.02302 10.0006Z"
                      fill="black"/>
            </svg>
            Back
        </a>
    </div>

    <div class="section-dashboard-content flex flow-column">
        <div class="content-item">
            <form id="editContactForm" action="{{ route('user.contacts.update', ['contact' => $contact->id]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="a-form__section">
                    <div class="a-form__item">
                        <div class="a-form__item-box">
                            <label for="first_name" class="a-form__item__label">First Name</label>
                            <input class="a-input a-input-brand @error('first_name') is-invalid @enderror"
                                   id="first_name" name="first_name" value="{{ $contact->first_name }}" type="text"
                                   placeholder="Enter First name..."/>
                            <span class="invalid-feedback" role="alert">
                                <strong>@error('first_name'){{ $message }}@enderror</strong>
                            </span>

                        </div>
                        <div class="a-form__item-box">
                            <label for="method_contact" class="a-form__item__label">Method of Contact</label>
                            <input class="a-input a-input-brand @error('contact_method') is-invalid @enderror"
                                   id="method_contact" name="contact_method" value="{{ $contact->contact_method }}" type="text"
                                   placeholder="Enter method of contact..."/>

                            <span class="invalid-feedback" role="alert">
                                        <strong>@error('contact_method'){{ $message }}@enderror</strong>
                                    </span>

                        </div>
                    </div>
                    <div class="a-form__item">
                        <div class="a-form__item-box">
                            <label for="last_name" class="a-form__item__label">Last Name</label>
                            <input class="a-input a-input-brand @error('last_name') is-invalid @enderror"
                                   id="last_name" name="last_name" value="{{ $contact->last_name }}" type="text"
                                   placeholder="Enter Last name..."/>

                            <span class="invalid-feedback" role="alert">
                                        <strong>@error('last_name'){{ $message }}@enderror</strong>
                                    </span>

                        </div>
                        <div class="a-form__item-box">
                            <label for="topic_conversation" class="a-form__item__label">Topic of
                                Conversation</label>
                            <input class="a-input a-input-brand addable @error('conversation_topic.0') is-invalid @enderror"
                                   id="topic_conversation" name="conversation_topic[]" value="{{ $contact->conversation_topic[0] ?? '' }}" type="text"
                                   placeholder="Enter topic of conversation..."/>

                            <span class="invalid-feedback" role="alert">
                                        <strong>@error('conversation_topic'){{ $message }}@enderror</strong>
                                    </span>


                            @if($topics = old('conversation_topic', $contact->conversation_topic ?? []))
                                @foreach($topics as $topic)
                                    @continue($loop->first)
                                    <div class="multiple-input-deletable">
                                        <input class="a-input a-input-brand addable deletable" name="conversation_topic[]" value="{{ $topic }}"
                                               type="text"
                                               placeholder="Enter topic of conversation...">

                                        <span class="invalid-feedback" role="alert">
                                                <strong>@error("conversation_topic.$loop->index"){{ $message }}@enderror</strong>
                                            </span>

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
                            <label for="company_name" class="a-form__item__label">Company Name</label>
                            <input class="a-input a-input-brand @error('company') is-invalid @enderror"
                                   id="company_name" name="company" value="{{ $contact->company }}" type="text"
                                   placeholder="Enter company name..."/>

                            <span class="invalid-feedback" role="alert">
                                        <strong>@error('company'){{ $message }}@enderror</strong>
                                    </span>

                        </div>
                        <div class="a-form__item-box">
                            <label for="specific_advice" class="a-form__item__label">Specific Advice or Feedback
                                Received</label>
                            <input class="a-input a-input-brand addable @error('advice_or_feedback.0') is-invalid @enderror"
                                   id="specific_advice" name="advice_or_feedback[]" value="{{ $contact->advice_or_feedback[0] ?? '' }}" type="text"
                                   placeholder="Enter specific advice or feedback Received"/>

                            <span class="invalid-feedback" role="alert">
                                        <strong>@error('advice_or_feedback'){{ $message }}@enderror</strong>
                                    </span>


                            @if($advices = old('advice_or_feedback', $contact->advice_or_feedback ?? []))
                                @foreach($advices as $advice)
                                    @continue($loop->first)
                                    <div class="multiple-input-deletable">
                                        <input class="a-input a-input-brand addable deletable" name="conversation_topic[]" value="{{ $advice }}"
                                               type="text"
                                               placeholder="Enter topic of conversation...">

                                        <span class="invalid-feedback" role="alert">
                                                <strong>@error("conversation_topic.$loop->index"){{ $message }}@enderror</strong>
                                            </span>

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
                                   id="position" name="position" value="{{ $contact->position }}" type="text"
                                   placeholder="Enter position..."/>

                            <span class="invalid-feedback" role="alert">
                                        <strong>@error('position'){{ $message }}@enderror</strong>
                                    </span>

                        </div>
                        <div class="a-form__item-box">
                            <label for="hobbies" class="a-form__item__label">Interests or Hobbies</label>
                            <input class="a-input a-input-brand addable @error('interests_or_hobbies.0') is-invalid @enderror"
                                   id="hobbies" name="interests_or_hobbies[]" value="{{ $contact->interests_or_hobbies[0] ?? '' }}" type="text"
                                   placeholder="Enter interests or hobbies..."/>

                            <span class="invalid-feedback" role="alert">
                                        <strong>@error('interests_or_hobbies'){{ $message }}@enderror</strong>
                                    </span>



                            @if($interests = old('interests_or_hobbies', $contact->interests_or_hobbies ?? []))
                                @foreach($interests as $interest)
                                    @continue($loop->first)
                                    <div class="multiple-input-deletable">
                                        <input class="a-input a-input-brand addable deletable" name="conversation_topic[]" value="{{ $interest }}"
                                               type="text"
                                               placeholder="Enter topic of conversation...">

                                        <span class="invalid-feedback" role="alert">
                                                <strong>@error("conversation_topic.$loop->index"){{ $message }}@enderror</strong>
                                            </span>

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
                                   id="mutual_connection" name="mutual_connection" value="{{ $contact->mutual_connection }}" type="text"
                                   placeholder="Enter mutual connection..."/>

                            <span class="invalid-feedback" role="alert">
                                        <strong>@error('mutual_connection'){{ $message }}@enderror</strong>
                                    </span>

                        </div>

                        <div class="a-form__item-box">
                            <label class="a-form__item__label">Status</label>
                            <div class="dropdown">
                                <button class="dropdown__button @if($contact->status) select-active @endif @error('status') is-invalid @enderror" type="button">
                                    {{ $contact->status_name ?? 'Choose status...' }}</button>

                                <span class="invalid-feedback" role="alert">
                                            <strong>@error('status'){{ $message }}@enderror</strong>
                                        </span>

                                <ul class="dropdown__list">
                                    @foreach($statuses as $id => $status)
                                        <li class="dropdown__list-item @if($contact->status == $id) dropdown__list-item_active @endif" data-value="{{ $id }}">{{ $status }}</li>
                                    @endforeach
                                    <input class="dropdown__input_hidden" type="text" name="status" value="{{ $contact->status }}">
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="a-form__item">
                        <div class="a-form__item-box">
                            <label class="a-form__item__label">Type</label>
                            <div class="dropdown">
                                <button class="dropdown__button @if($contact->type) select-active @endif @error('type') is-invalid @enderror" type="button">
                                    {{ $contact->type_name ?? 'Choose type...' }}</button>

                                <span class="invalid-feedback" role="alert">
                                            <strong>@error('type'){{ $message }}@enderror</strong>
                                        </span>

                                <ul class="dropdown__list">
                                    @foreach($types as $id => $type)
                                        <li class="dropdown__list-item @if($contact->type == $id) dropdown__list-item_active @endif" data-value="{{ $id }}">{{ $type }}</li>
                                    @endforeach
                                    <input class="dropdown__input_hidden" type="text" name="type" value="{{ $contact->type }}">
                                </ul>
                            </div>
                        </div>
                        <div class="a-form__item-box">
                        </div>
                    </div>
                    <div class="a-form__item">
                        <div class="a-form__item-box">
                            <label for="date_сontacted" class="a-form__item__label">Date Contacted</label>
                            <!--                                    <input class="a-input a-input-brand @error('date_сontacted') is-invalid @enderror"-->
                            <!--                                           id="date_сontacted" name="date_сontacted" value="" type="text"-->
                            <!--                                           placeholder="Enter mutual connection..."/>-->
                            <input class="a-input a-input-brand @error('contacted_at') is-invalid @enderror"
                                   type="date" data-date="" data-date-format="DD MMMM YYYY"
                                   id="date_сontacted" name="contacted_at" value="{{ $contact->simple_contacted_at }}"
                                   placeholder="Choose date contacted..." required>

                            <span class="invalid-feedback" role="alert">
                                        <strong>@error('contacted_at'){{ $message }}@enderror</strong>
                                    </span>

                        </div>
                        <div class="a-form__item-box">
                        </div>
                    </div>
                    <div class="a-form__item">
                        <div class="a-form__item-box">
                            <label class="a-form__item__label">Contact Details</label>
                            <input class="a-input a-input-brand @error('contact_details.phone') is-invalid @enderror"
                                   id="mobile" name="contact_details[phone]" value="{{ $contact->contact_details['phone'] ?? '' }}" type="text"
                                   placeholder="Enter mobile..."/>
                            <input class="a-input a-input-brand @error('contact_details.email') is-invalid @enderror"
                                   id="email" name="contact_details[email]" value="{{ $contact->contact_details['email'] ?? '' }}" type="email"
                                   placeholder="Enter email..."/>
                            @if(is_array($contact->contact_details))
                                @foreach($contact->contact_details as $i => $contact_detail)
                                    @continue($i == 'phone' || $i == 'email')
                                    <div class="multiple-input-deletable">
                                        <input class="a-input a-input-brand @error('contact_details.'.$i) is-invalid @enderror"
                                               name="contact_details[{{ $i }}]" value="{{ $contact_detail }}" type="text"/>
                                        <span class="delete"></span>
                                    </div>
                                @endforeach
                            @endif
                            <button type="button" data-name="contact_details" class="a-form__item-box__add-more flex align-center add-input">
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
                    <button class="btn btn-black" type="submit">Save Contact</button>
                </div>
            </form>
        </div>
    </div>
</div>
