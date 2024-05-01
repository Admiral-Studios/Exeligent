<div class="dashboard-part-content text-img">
    <div class="text-content">
        <div class="title">{!! $block->title_html !!}</div>
        <div class="description">{!! $block->content !!}</div>
    </div>

    @if($block->additional_content instanceof \Illuminate\Support\Collection && isset($block->additional_content['img']))
    <div class="img-content">
        <img src="{{ page_img_url($block->additional_content['img']) }}" alt="img">
    </div>
    @endif
</div>
