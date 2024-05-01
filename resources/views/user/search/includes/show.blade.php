<div class="section-dashboard section-dashboard-search btn-back-section">
    <div class="section-dashboard-title flex flow-column">
        <h2>Executive Info</h2>
        <a class="flex align-center fw-medium fz-016 close-executive" href="{{ url()->previous() }}">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.02302 10.0006L13.1478 14.1253L11.9693 15.3038L6.66602 10.0006L11.9693 4.69727L13.1478 5.87577L9.02302 10.0006Z"
                    fill="black"/>
            </svg>
            Back
        </a>
    </div>

    <div class="section-dashboard-content flex flow-column">
        <div class="content-item">
            <span class="fw-semibold fz-014 black">Name:</span>
            <div class="company-name fw-bold fz-018 black">{{ $executive->full_name }}</div>
            <ul class="filters-list flex align-center">
                @foreach(\App\Models\Executive::ALL_PROPERTIES as $property)
                    @continue(!is_array($executive->$property) || empty($executive->$property))
                    <li class="filters-item flex align-center">
                        <span class="fw-bold fz-012 black">{{ ucfirst($property) }}:</span>
                        <span class="fw-regular fz-012 black">{{ implode(', ', $executive->$property) }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="description-box">
                @if($executive->company)
                    <span class="fw-semibold fz-014 black">Company:</span>
                    <div class="company-name fw-bold fz-018 black">{{ $executive->company }}</div>
                @endif
                @if($executive->address)
                    <span class="fw-semibold fz-014 black">Address:</span>
                    <div class="company-name fw-bold fz-018 black">{{ $executive->address }}</div>
                @endif
                @if($executive->phone)
                    <span class="fw-semibold fz-014 black">Phone:</span>
                    <div class="company-name fw-bold fz-018 black">{{ $executive->phone }}</div>
                @endif
            </div>
            @if($executive->url)
            <div class="link-box flex flow-column">
                <span class="fw-semibold fz-014 black">Link:</span>
                <a class="fw-light fz-014 black" href="{{ $executive->url }}" target="_blank">
                    {{ $executive->url }}
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
