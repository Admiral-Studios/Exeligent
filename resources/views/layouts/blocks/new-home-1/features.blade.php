<section class="small-banner">
    <div class="wrapper-container">
        <div class="small-banner__wrapper">
            <ul class="small-banner__list">
                @if($block->additional_content instanceof \Illuminate\Support\Collection)
                    @foreach($block->additional_content as $i => $item)
                        @continue(!(int) $i)
                            <li>
                                @if(isset($item['img']))
                                    <img src="{{ page_img_url($item['img']) }}" width="48px">
                                @endif
                                <div class="title">{{ $item['subject'] }}</div>
                            </li>
                    @endforeach
                @endif
            </ul>
            <h2 class="title">{!! $block->content !!}</h2>
            <div class="logo">
                @if($block->additional_content instanceof \Illuminate\Support\Collection && isset($block->additional_content['img']))
                    <img src="{{ page_img_url($block->additional_content['img']) }}" alt="image">
                @endif
                {{ $block->title }}
            </div>
        </div>
    </div>
</section>
