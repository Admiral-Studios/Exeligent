<section class="section explore-section">
    <div class="explore-wrapper-container">
        <div class="explore-wrapper flex align-center">
            <div class="explore-section-info">

                @if($block->title)
                    <h2 class="title-section">{{ $block->title }}</h2>
                @endif

                @if($block->content)
                    <div class="description-section">{!! $block->content !!}</div>
                @endif

                @if(is_array($block->button) && isset($block->button['text']))
                    <a class="btn btn-black fz-024"
                       href="{{ $block->button['link'] ?? '' }}">{{ $block->button['text'] ?? '' }}</a>
                @endif

            </div>

            @if($block->additional_content instanceof \Illuminate\Support\Collection)
                <div class="explore-section-image">
                    <img src="{{ isset($block->additional_content['img']) ? page_img_url($block->additional_content['img']) : '' }}" alt="image" loading="lazy">
                </div>
            @endif

        </div>
    </div>
</section>
