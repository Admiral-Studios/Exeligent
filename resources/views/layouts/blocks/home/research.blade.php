<section class="section research-section">
    <div class="wrapper-container">
        @if($block->title)
            <div class="research-section-percent-box flex align-center justify-center">
                <div class="percent fw-medium fz-098 black sf-medium" data-percent="{{ intval($block->title) }}">{{ $block->title }}</div>
            </div>
        @endif

        @if($block->content)
            <div class="research-section-description inter fw-medium fz-024 black">{!!  $block->content !!}</div>
        @endif

    </div>
</section>
