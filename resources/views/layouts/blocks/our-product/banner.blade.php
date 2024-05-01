<section class="section our-product-banner">
    <div class="wrapper-container">
        <div class="our-product-banner-wrapper">
            @if($block->title)
                <h1 class="title-section">{{ $block->title }}</h1>
            @endif
            @if($block->sub_title)
                <div class="subtitle-section"><p>{!! $block->sub_title_html !!}</p></div>
            @endif

            @if($block->content)
                <div class="description-section">{!! $block->content !!}</div>
            @endif
        </div>
    </div>
</section>
