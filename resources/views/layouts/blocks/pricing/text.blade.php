<section class="section section-key-features" style="padding-bottom: 0">
    <div class="wrapper-container">

        @if($block->title)
            <h1 class="title-section">{{ $block->title }}</h1>
        @endif

        @if($block->content)
            <div class="description-section">{!! $block->content !!}</div>
        @endif

    </div>
</section>
