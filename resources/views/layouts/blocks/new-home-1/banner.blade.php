<section class="banner-home"
         @if($block->additional_content instanceof \Illuminate\Support\Collection && isset($block->additional_content['img']))
             style="background-image: url('{{ page_img_url($block->additional_content['img']) }}');background-position: center;"
          @endif>
    <div class="wrapper-container">
        <div class="banner-home__wrapper">
            <h1 class="title">{{ $block->title ?? '' }}</h1>
            @if($block->content)
            <div class="description">{!! $block->content !!}</div>
            @endif
            @if(is_array($block->button) && isset($block->button['text']))
                <a class="btn btn-blue" href="{{ $block->button['link'] ?? '#' }}">{{ $block->button['text'] ?? '' }}</a>
            @endif
        </div>
    </div>
</section>
