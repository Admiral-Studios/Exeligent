<section class="section flexible-section">
    <div class="wrapper-container">
        <div class="flexible-wrapper">
            @if($block->title)
            <h2 class="title">{!! $block->title_html !!}</h2>
            @endif
            <div class="description">{!! $block->content !!}</div>
            @if(is_array($block->button) && isset($block->button['text']))
                <a class="btn btn-black" href="{{ $block->button['link'] }}">{{ $block->button['text'] }}</a>
            @endif
        </div>
    </div>
</section>
