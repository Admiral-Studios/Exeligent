<section class="section who-section">
    <div class="wrapper-container">
        @if($block->title)
            <h2 class="title-section">{{ $block->title }}</h2>
        @endif
        @if($block->content)
            <div class="description-section">{!! $block->content !!}</div>
        @endif

        @if($block->additional_content instanceof \Illuminate\Support\Collection)
            <div class="who-section-list flex">
                @php($half_count = intval(ceil($block->additional_content->count() / 2)))
                @php($i = 1)
                @foreach($block->additional_content->chunk($half_count) as $half_items)
                    <div class="who-section-list-box flex flow-column">
                        @foreach($half_items as $item)
                            <div class="item flex">
                                <div
                                    class="decoration gray fz-040 fw-bold neue-bold">{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}</div>
                                <div class="item-description fz-024 fw-medium inter dark">{!! $item !!}</div>
                            </div>
                            @php($i++)
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
