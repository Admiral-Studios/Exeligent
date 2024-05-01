<section class="section bottom-image-section">
    <div class="wrapper-container">
        <div class="bottom-image-section-wrapper">
            @if($block->title)
                <h2 class="title">{!! $block->title_html !!}</h2>
            @endif
            @if(isset($block->additional_content['show_bg']))
                <img src="{{asset('/images/our-product/decoration-1.png')}}" class="decoration-title" alt="decoration">
            @endif
            @if($block->content)
                <div class="description">{!! $block->content !!}</div>
            @endif
            @if(isset($block->additional_content['img']))
                <div class="image">
                    @if(isset($block->additional_content['img']['desktop']))
                        <img class="desktop-img" src="{{ page_img_url($block->additional_content['img']['desktop']) }}" alt="image">
                    @endif
                    @if(isset($block->additional_content['img']['mobile']))
                        <img class="mobile-img" src="{{ page_img_url($block->additional_content['img']['mobile']) }}" alt="image">
                    @endif
                </div>
            @endif
        </div>
    </div>
</section>
