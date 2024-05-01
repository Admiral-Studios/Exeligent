<section class="home-bottom">
    <div class="wrapper-container">
        <div class="home-bottom__wrapper">
            @if($block->additional_content instanceof \Illuminate\Support\Collection && isset($block->additional_content['img']))
            <div class="image">
                <img width="310" height="416" src="{{ page_img_url($block->additional_content['img']) }}" alt="avatar" style="object-fit: cover;">
            </div>
            @endif

            <div class="info">
                <div class="title">{{ $block->title ?? '' }}</div>
                <div class="subtitle">{!! $block->content !!}</div>
                @if(is_array($block->button) && isset($block->button['text']))
                    <a class="btn btn-blue" href="{{ $block->button['link'] ?? '#' }}">{{ $block->button['text'] ?? '' }}</a>
                @endif
            </div>
        </div>
    </div>
</section>
