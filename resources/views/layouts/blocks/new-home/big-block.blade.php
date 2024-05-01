<div class="section network-section">
    <div class="wrapper-container">
        <div class="network-title-section">
            @if($block->title)
            <div class="title">{!! $block->title_html !!}</div>
            @endif
            @if($block->content)
                <div class="subtitle">{!! $block->content !!}</div>
            @endif
        </div>
        @if($block->additional_content instanceof \Illuminate\Support\Collection && isset($block->additional_content['img']))
        <div class="network-img">
            <img src="{{ page_img_url($block->additional_content['img']) }}" alt="image">
        </div>
        @endif
    </div>
</div>
