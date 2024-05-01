<div class="section home-banner-section">
    <div class="wrapper-container">
        <div class="home-banner">
            <div class="home-banner__wrapper flex align-center">
                <div class="info">
                    <h1 class="title">{{ $block->title }}</h1>

                    @if($block->sub_title)
                    <p class="subtitle">{{ $block->sub_title }}</p>
                    @endif

                    @if(is_array($block->button) && isset($block->button['text']))
                        <a href="{{ $block->button['link'] ?? '#' }}" class="btn btn-black">{{ $block->button['text'] ?? '' }}</a>
                    @endif
                </div>

                @if($block->additional_content instanceof \Illuminate\Support\Collection)
                <div class="image">
                    <img width="504" height="380" src="{{ isset($block->additional_content['img']) ? page_img_url($block->additional_content['img']) : '' }}" alt="banner img">
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
