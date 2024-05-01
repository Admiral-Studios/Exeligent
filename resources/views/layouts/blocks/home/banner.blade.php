<section class="section banner-section">
    <div class="wrapper-container">

        @if($block->title)
            <h1 class="banner-section-title fw-bold fz-064 dark neue-bold">{{ $block->title }}</h1>
        @endif

        @if($block->sub_title)
            <div class="banner-section-subtitle fw-regular fz-040 dark myanmar">{{ $block->sub_title }}</div>
        @endif

        @if($block->content)
            <div class="description-section">{!! $block->content !!}</div>
        @endif

        @if(is_array($block->button) && isset($block->button['text']))
            <a class="btn btn-black fz-024"
               href="{{ $block->button['link'] ?? '#' }}">{{ $block->button['text'] ?? '' }}</a>
        @endif

    </div>
</section>
