<section class="section why-section">
    <div class="wrapper-container">
        @if($block->title)
            <h2 class="title-section">{{ $block->title }}</h2>
        @endif

        @if($block->content)
            <div class="description-section">{!! $block->content !!}</div>
        @endif

        @if($block->additional_content instanceof \Illuminate\Support\Collection)
            <ul class="why-section-list flex">
                @foreach($block->additional_content as $item)
                    <li class="why-section-item">
                        <div class="image">
                            <img src="{{ isset($item['img']) ? page_img_url($item['img']) : '' }}" alt="image" loading="lazy">
                        </div>
                        <div class="title inter fw-semibold fz-032 dark">{{ $item['subject'] ?? '' }}</div>
                        <div class="description inter black fz-018 fw-regular">{!! $item['content'] ?? '' !!}</div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</section>
