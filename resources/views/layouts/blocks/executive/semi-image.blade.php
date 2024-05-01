@php($left_align = isset($block->additional_content['img_align']) && $block->additional_content['img_align'] == 'left')

<div class="section info-img-section @if(!$left_align) right @endif">
    <div class="wrapper-container">
        <div class="info-img-wrapper flex align-center">
            @if($block->additional_content instanceof \Illuminate\Support\Collection && isset($block->additional_content['img']))
                <div class="image">
                    <img width="647" height="366" src="{{ page_img_url($block->additional_content['img']) }}" alt="image">
                </div>
            @endif
            <div class="info">
                <div class="title">{!! $block->title_html !!}</div>
                <div class="description">{!! $block->content !!}</div>
            </div>
        </div>
    </div>
</div>
