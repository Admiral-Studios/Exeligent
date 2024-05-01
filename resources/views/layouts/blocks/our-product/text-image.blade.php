<section class="section text-image-section @if(($block->additional_content['img_align'] ?? '') == 'left') image-left @else image-right @endif">
    @if(($block->additional_content['img_align'] ?? '') == 'left')
        <img src="{{ asset('/images/our-product/decoration-3.png') }}" class="decoration-left" alt="decoration">
    @else
        <img src="{{asset('/images/our-product/decoration-2.png')}}" class="decoration-right" alt="decoration">
    @endif
    <div class="wrapper-container">
        <div class="text-image-section-wrapper">
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
            <div class="main-block">
                @if($block->title)
                    <h2 class="title">{!! $block->title_html !!}</h2>
                @endif
                @if($block->content)
                    <div class="description">{!! $block->content !!}</div>
                @endif
            </div>
        </div>
    </div>
</section>
