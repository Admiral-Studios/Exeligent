<div class="section steps-section">
    <div class="wrapper-container">
        <div class="steps-wrapper">
            <div class="info">
                <div>
                    @if($block->title)
                    <div class="section-title">{!! $block->title_html !!}</div>
                    @endif
                    @if($block->content)
                        {!! $block->content !!}
                    @endif
                </div>
                @if($block->additional_content instanceof \Illuminate\Support\Collection && isset($block->additional_content['img']))
                    <div class="image"
                         style="background-image: url('{{ page_img_url($block->additional_content['img']) }}'), url('../images/home/steps-bg.svg');">
                    </div>
                @endif
            </div>
            @if($block->additional_content instanceof \Illuminate\Support\Collection)
            <ul class="steps-list">
                @foreach($block->additional_content as $i => $item)
                    @continue($i == 'img')
                    <li>
                        <span>{{ str_pad($loop->iteration, 2, 0, STR_PAD_LEFT) }}</span>
                        {{ $item }}
                    </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</div>
