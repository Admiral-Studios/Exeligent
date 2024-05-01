<div class="section-dashboard section-dashboard-interviews">
    <div class="section-dashboard-title flex flow-column">
        <h2>{{ $block->title }}</h2>
        <div class="inter fw-regular fz-012 dark">{{ $block->sub_title }}</div>
    </div>

    <div class="section-dashboard-content flex flow-column">
        @if($block->additional_content instanceof \Illuminate\Support\Collection)
        @foreach($block->additional_content as $item)
        <div class="content-item">
            <div class="accordion-item">
                <div class="accordion-item-header fz-018 neue-bold dark">{{ $item['subject'] ?? '' }}</div>
                <div class="accordion-item-body" style="max-height: 100%;">
                    <div class="accordion-item-body-content interviews-text">{!! $item['content'] ?? '' !!}</div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
