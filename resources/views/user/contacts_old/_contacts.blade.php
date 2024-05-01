@if($contacts->count())
<ul class="leadership-list-section flex align-center flex-between">
    @php($status = null)
    @foreach($contacts as $contact)
        <li class="list-item">
            <a class="flex align-center show-contact" href="{{ route('user.contacts.show', ['contact' => $contact->id]) }}">
                <div class="book-name">{{ $contact->first_name . ' ' . $contact->last_name }}</div>
                <div class="book-author">{{ $contact->company }}</div>
                <span></span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.4144 10.5861L13.1213 6.29297L11.7072 7.70701L15.0003 11.0001H5V13.0002H15.0003L11.7072 16.2933L13.1213 17.7073L17.4144 13.4142C17.7894 13.0391 18 12.5305 18 12.0002C18 11.4698 17.7894 10.9612 17.4144 10.5861Z"
                          fill="black"/>
                </svg>
            </a>
        </li>
    @endforeach
</ul>
<div class="pagination-wrapper" @if($status) data-status="{{ $status }}" @endif>
    {{ $contacts->links() }}
</div>
@endif
