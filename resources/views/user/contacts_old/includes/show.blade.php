<div class="section-dashboard section-dashboard-networking btn-back-section">
    <div class="section-dashboard-title flex flow-column">
        <div class="flex flow-column">
            <h2>Contact Info</h2>
        </div>
        <a class="flex align-center fw-medium fz-016 close-contact" href="{{ route('user.contacts.index') }}">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.02302 10.0006L13.1478 14.1253L11.9693 15.3038L6.66602 10.0006L11.9693 4.69727L13.1478 5.87577L9.02302 10.0006Z"
                      fill="black"/>
            </svg>
            Back
        </a>
    </div>
    <div class="section-dashboard-content max-width flex flow-column">
        <div class="content-item">
            <ul class="info-list flex">
                <li>
                    <div class="info-title">First Name</div>
                    <div class="info-data">{{ $contact->first_name }}</div>
                </li>
                <li>
                    <div class="info-title">Last Name</div>
                    <div class="info-data">{{ $contact->last_name }}</div>
                </li>
                @if($contact->company)
                    <li>
                        <div class="info-title">Company Name</div>
                        <div class="info-data">{{ $contact->company }}</div>
                    </li>
                @endif
                @if($contact->position)
                    <li>
                        <div class="info-title">Position</div>
                        <div class="info-data">{{ $contact->position }}</div>
                    </li>
                @endif
            </ul>

            @if($contact->mutual_connection)
                <div class="info-box">
                    <div class="info-title">Mutual Connection</div>
                    <div class="info-data">{{ $contact->mutual_connection }}</div>
                </div>
            @endif
            @if($contact->type)
                <div class="info-box">
                    <div class="info-title">Type</div>
                    <div class="info-data">{{ $contact->type_name }}</div>
                </div>
            @endif
            @if($contact->contacted_at)
                <div class="info-box">
                    <div class="info-title">Date Contacted</div>
                    <div class="info-data">{{ $contact->pretty_contacted_at }}</div>
                </div>
            @endif
            @if(is_array($contact->contact_details) && array_filter($contact->contact_details))
                <div class="info-box">
                    <div class="info-title">Contact Details</div>
                    @foreach($contact->contact_details as $contact_detail)
                        <div class="info-data">{{ $contact_detail }}</div>
                    @endforeach
                </div>
            @endif
            @if($contact->contact_method)
                <div class="info-box">
                    <div class="info-title">Method of Contact</div>
                    <div class="info-data">{{ $contact->contact_method }}</div>
                </div>
            @endif
            @if(is_array($contact->conversation_topic) && !empty($contact->conversation_topic))
                <div class="info-box">
                    <div class="info-title">Topic of Conversation</div>
                    @foreach($contact->conversation_topic as $topic)
                        <div class="info-data">{{ $topic }}</div>
                    @endforeach
                </div>
            @endif
            @if(is_array($contact->advice_or_feedback) && !empty($contact->advice_or_feedback))
                <div class="info-box">
                    <div class="info-title">Specific Advice or Feedback Received</div>
                    @foreach($contact->advice_or_feedback as $advice_or_feedback)
                        <div class="info-data">{{ $advice_or_feedback }}</div>
                    @endforeach
                </div>
            @endif
            @if(is_array($contact->interests_or_hobbies) && !empty($contact->interests_or_hobbies))
                <div class="info-box">
                    <div class="info-title">Interests or Hobbies</div>
                    @foreach($contact->interests_or_hobbies as $interests_or_hobbies)
                        <div class="info-data">{{ $interests_or_hobbies }}</div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="btn-edit">
        <form action="{{ route('user.contacts.destroy', $contact) }}" method="POST" style="text-align: end;">
            @csrf
            @method('DELETE')
            <a class="btn btn-black opacity edit-contact" href="{{ route('user.contacts.edit', ['contact' => $contact->id]) }}" style="display: inline-block!important;">Edit</a>
            <button type="submit" class="btn btn-black opacity" onclick="return confirm('Are you sure?')" style="display: inline-block!important;background-color: #690000">Delete</button>
        </form>
    </div>
</div>
