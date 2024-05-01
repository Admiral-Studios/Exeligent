<div class="section accordion-section">
    <div class="wrapper-container">
        @if($block->title)
            <h2 class="section-title">{{ $block->title }}</h2>
        @endif

        @if($block->additional_content instanceof \Illuminate\Support\Collection)
            <div class="accordion">
                @foreach($block->additional_content as $item)
                <div class="accordion-item">
                    <div class="accordion-item-header">{{ $item['subject'] ?? '' }}</div>
                    <div class="accordion-item-body">
                        <div class="accordion-item-body-content">{!! $item['content'] ?? '' !!}</div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
