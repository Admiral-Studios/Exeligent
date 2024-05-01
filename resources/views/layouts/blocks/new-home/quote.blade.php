<div class="section small-banner-section">
    <div class="wrapper-container">
        <div class="small-banner">
            <div class="small-banner__wrapper flex align-center">
                <div class="small-banner__company flex align-center">
                    @if($block->additional_content instanceof \Illuminate\Support\Collection)
                        <img src="{{ isset($block->additional_content['img']) ? page_img_url($block->additional_content['img']) : '' }}">
                    @endif
                    {{ $block->title ?? '' }}
                </div>

                <div class="small-banner__info">{!! $block->content !!}</div>
            </div>
        </div>
    </div>
</div>
