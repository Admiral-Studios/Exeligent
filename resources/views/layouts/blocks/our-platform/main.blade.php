<section class="section our-platform-section">
    <div class="wrapper-container">
        @if($block->title)
            <h1 class="title-section">{{ $block->title }}</h1>
        @endif

        @if($block->content)
            <div class="description-section">{!! $block->content ?? '' !!}</div>
        @endif

        @if($block->additional_content instanceof \Illuminate\Support\Collection)
            <ul class="our-platform-section-list flex">
                @foreach($block->additional_content as $item)
                    <li class="our-platform-section-item">
                        <img src="{{ isset($item['img']) ? page_img_url($item['img']) : '' }}">
                        <h4 class="title inter fw-semibold fz-032 dark text-center">{{ $item['subject'] ?? '' }}</h4>
                        <div class="description inter fw-regular fz-018 black text-center">{!! $item['content'] !!}</div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</section>
