<div class="section single-img-section">
    <div class="wrapper-container">
        @if($block->additional_content instanceof \Illuminate\Support\Collection && isset($block->additional_content['img']))
        <div class="single-img">
            <img width="872" height="539" src="{{ page_img_url($block->additional_content['img']) }}" alt="image">
        </div>
        @endif
    </div>
</div>
